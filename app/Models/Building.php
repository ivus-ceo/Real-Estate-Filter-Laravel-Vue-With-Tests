<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected function street()
    {
        return $this->belongsTo(Street::class);
    }

    protected function developer()
    {
        return $this->belongsTo(Developer::class);
    }
}
