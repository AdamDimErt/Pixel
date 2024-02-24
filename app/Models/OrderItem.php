<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Screen\AsSource;

final class OrderItem extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $guarded = [];

    protected $allowedFilters = [
        'item_id'  => Where::class,
        'order_id' => Where::class,
    ];

    protected $allowedSorts = [
        'item_id'  => Where::class,
        'order_id' => Where::class,
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
