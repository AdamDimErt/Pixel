<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'rent_start' => 'datetime:Y-m-d h:m:s',
        'rent_end' => 'datetime:Y-m-d h:m:s',
    ];

    protected $allowedFilters = [
        'user_id' => Where::class,
        'amount_paid' => WhereMaxMin::class,
        'status' => Where::class,
        'rent_start_at' => WhereDateStartEnd::class,
        'rent_end_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
        'deleted_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'user_id',
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
}
