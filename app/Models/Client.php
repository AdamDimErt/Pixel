<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Orchid\Attachment\Attachable;

class Client extends Authenticatable
{
    use Attachable, Authorizable, HasFactory;

    protected $guarded = [];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
