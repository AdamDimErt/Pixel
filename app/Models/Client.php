<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class Client extends Authenticatable
{
    use AsSource, Attachable, Authorizable, HasFactory, Filterable;

    protected $guarded = [];

    protected $allowedFilters = [
        'id' => Where::class,
        'name' => Like::class,
        'phone' => Like::class,
        'discount' => WhereMaxMin::class,
        'email' => Like::class,
        'instagram' => Like::class,
        'email_confirmed' => Where::class,
        'created_at' => WhereDateStartEnd::class,
        'deleted_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'phone',
        'discount',
        'email',
        'instagram',
        'email_confirmed',
        'created_at',
        'deleted_at',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
