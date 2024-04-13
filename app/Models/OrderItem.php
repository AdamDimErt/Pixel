<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

final class OrderItem extends Model
{
    use AsSource, Filterable, HasFactory;

    protected $guarded = [];

    protected $casts = [
        'additionals' => 'json',
    ];

    protected $allowedFilters = [
        'item_id' => Where::class,
        'order_id' => Where::class,
        'amount_of_days' => WhereMaxMin::class,
        'amount_paid' => WhereMaxMin::class,
        'rent_start_date' => WhereDateStartEnd::class,
        'rent_end_date' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'item_id',
        'order_id',
        'amount_paid',
        'rent_start_date',
        'rent_end_date'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function additionals(): HasMany
    {
        return $this->hasMany(Additional::class, 'id', 'additionals');
    }

    public function getAdditionals(): Collection
    {
        return Additional::whereIn('id', $this->additionals)->get();
    }
}
