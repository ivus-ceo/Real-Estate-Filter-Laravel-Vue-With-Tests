<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Malhal\Geographical\Geographical;

class Location extends Model
{
    use Geographical;

    protected static $kilometers = true;

    protected $fillable = [
        'latitude',
        'longitude',
    ];

    public function locationable(): MorphTo
    {
        return $this->morphTo();
    }
}
