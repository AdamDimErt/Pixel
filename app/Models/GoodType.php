<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereIn;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Screen\AsSource;

class GoodType extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:Y-m-d h:m:s',
    ];

    protected $allowedFilters = [
        'name'        => Like::class,
        'description' => Like::class,
        'created_at'  => WhereDateStartEnd::class,
        'deleted_at'  => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'name',
        'description',
        'created_at',
        'deleted_at',
    ];

    public function goods(): HasMany
    {
        return $this->hasMany(Good::class);
    }
}
