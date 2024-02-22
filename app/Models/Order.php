<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use HasFactory, AsSource, Filterable;
    protected $guarded = [];

    protected $allowedFilters = [
        'item_id'       => Where::class,
        'user_id'       => Where::class,
        'amount_paid'   => WhereMaxMin::class,
        'status'        => Where::class,
        'rent_start_at' => WhereDateStartEnd::class,
        'rent_end_at'   => WhereDateStartEnd::class,
        'created_at'    => WhereDateStartEnd::class,
        'deleted_at'    => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'item_id',
        'user_id',
        'amount_paid',
        'status',
        'rent_start_at',
        'rent_end_at',
        'created_at',
        'deleted_at',
    ];
    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
