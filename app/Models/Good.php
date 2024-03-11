<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class Good extends Model
{
    use AsSource, Attachable, Filterable, HasFactory;

    protected $guarded = [];

    protected $allowedFilters = [
        'name' => Like::class,
        'cost' => WhereMaxMin::class,
        'good_type_id' => Where::class,
        'description' => Like::class,
        'created_at' => WhereDateStartEnd::class,
        'deleted_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'name',
        'cost',
        'description',
        'good_type_id',
        'created_at',
        'deleted_at',
    ];

    protected $casts = [
        'related_goods' => 'json',
    ];

    public function goodType(): BelongsTo
    {
        return $this->belongsTo(GoodType::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function scopeAvailableItems() {
        return $this->items()->where('items.status', '=', 'available')->get();
    }

    public function scopeHasAvailableItems(Builder $query)
    {
        return $query->join('items', 'items.good_id', '=', 'goods.id')
            ->select([
                DB::raw('count(items.id) as items_count'),
                'goods.*',
            ])
            ->where('items.status', '=', 'available')
            ->having('items_count', '>', '0')
            ->groupBy('goods.id');
    }

    public function relatedGoods(): HasMany
    {
        return $this->hasMany(Good::class, 'id', 'related_goods');
    }

    public function addRelatedGood($relatedGoodId)
    {
        $relatedGoods = $this->related_goods ?? [];
        $relatedGoods = array_unique(array_merge($relatedGoods, [$relatedGoodId]));

        $this->update([
            'related_goods' => $relatedGoods,
        ]);
    }

    public function removeRelatedGood($relatedGoodId)
    {
        $relatedGoods = $this->related_goods ?? [];
        $relatedGoods = array_diff($relatedGoods, [$relatedGoodId]);

        $this->update([
            'related_goods' => $relatedGoods,
        ]);
    }
}
