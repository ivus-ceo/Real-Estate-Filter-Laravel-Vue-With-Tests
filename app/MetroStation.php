<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetroStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected function lines(): BelongsTo
    {
        return $this->belongsTo(MetroLine::class);
    }
}
