<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Metro extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected function lines(): HasMany
    {
        return $this->hasMany(MetroLine::class);
    }
}
