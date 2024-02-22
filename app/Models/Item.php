<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Screen\AsSource;

class Item extends Model
{
    use HasFactory, AsSource, Filterable;
    protected $guarded = [];

    protected $allowedFilters = [
        'good_id'      => Where::class,
        'status'       => Where::class,
        'created_at'   => WhereDateStartEnd::class,
        'deleted_at'   => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'good_id',
        'status',
        'created_at',
        'deleted_at',
    ];
    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }

    public function getNameAttribute(): string
    {
        return $this->good->name . " ($this->id)";
    }
}
