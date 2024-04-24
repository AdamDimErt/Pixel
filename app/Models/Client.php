<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Mail\Attachment;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class Client extends Authenticatable
{
    use AsSource, Attachable, Authorizable, Filterable, HasFactory;

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

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function signature()
    {
        $this->load('attachment');
        return $this->attachment()->where('group', '=', 'signatures')->first();
    }

    public function idCards(): Collection
    {
        $this->load('attachment');
        return $this->attachment()->where('group', '=', 'idCards')->get();
    }
}
