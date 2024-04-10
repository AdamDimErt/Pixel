<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use AsSource, Filterable, HasFactory, Attachable;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:Y-m-d h:m:s',
    ];

    protected $allowedFilters = [
        'client_id' => Where::class,
        'agreement_id' => Where::class,
        'amount_paid' => WhereMaxMin::class,
        'status' => Where::class,
        'created_at' => WhereDateStartEnd::class,
        'deleted_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'client_id',
        'agreement_id',
        'amount_paid',
        'status',
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

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'order_items');
    }
}
