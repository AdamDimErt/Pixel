<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class GoodType extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $guarded = [];

    public function goods(): HasMany
    {
        return $this->hasMany(Good::class);
    }
}
