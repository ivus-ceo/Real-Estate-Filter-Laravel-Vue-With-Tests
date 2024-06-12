<?php

namespace App\Models;

use App\Traits\Models\HasPublishDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Developer extends Model
{
    use HasFactory, HasPublishDateTrait;

    protected $fillable = [
        'name',
    ];

    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }
}
