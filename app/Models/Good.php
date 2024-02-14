<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class Good extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    public function goodType(): BelongsTo
    {
        return $this->belongsTo(GoodType::class);
    }
}
