<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'good_id', 'client_id',
    ];

    /**
     * Get the good that owns the favorite.
     */
    public function good()
    {
        return $this->belongsTo(Good::class);
    }

    /**
     * Get the client that owns the favorite.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
