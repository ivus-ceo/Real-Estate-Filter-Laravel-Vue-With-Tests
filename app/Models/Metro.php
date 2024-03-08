<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
