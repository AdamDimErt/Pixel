<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use AsSource, Filterable, HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:Y-m-d h:m:s',
    ];

    protected $allowedFilters = [
        'client_id' => Where::class,
        'amount_paid' => WhereMaxMin::class,
        'status' => Where::class,
        'rent_start_at' => WhereDateStartEnd::class,
        'rent_end_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
        'deleted_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'client_id',
        'amount_paid',
        'status',
        'rent_start_at',
        'rent_end_at',
        'created_at',
        'deleted_at',
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFirstOrderDate()
    {
        $firstOrder = $this->firstOrder();
        return $firstOrder->rent_start_date . ' ' . $firstOrder->rent_start_time;
    }

    public function getLastOrderDate()
    {
        $firstOrder = $this->lastOrder();
        return $firstOrder->rent_end_date . ' ' . $firstOrder->rent_end_time;
    }

    public function firstOrder()
    {
        return $this->orderItems()
            ->orderBy('rent_start_date', 'ASC')
            ->orderBy('rent_start_time', 'ASC')
            ->first(['rent_start_date', 'rent_start_time']);
    }

    public function lastOrder()
    {
        return $this->orderItems()
            ->orderBy('rent_end_date', 'DESC')
            ->orderBy('rent_end_time', 'DESC')
            ->first(['rent_end_date', 'rent_end_time']);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'order_items');
    }
}
