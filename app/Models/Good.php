<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class Good extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;
    protected $guarded = [];

    protected $allowedFilters = [
        'name'         => Like::class,
        'cost'         => WhereMaxMin::class,
        'good_type_id' => Where::class,
        'description'  => Like::class,
        'created_at'   => WhereDateStartEnd::class,
        'deleted_at'   => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'name',
        'cost',
        'description',
        'good_type_id',
        'created_at',
        'deleted_at',
    ];
    public function goodType(): BelongsTo
    {
        return $this->belongsTo(GoodType::class);
    }
}
