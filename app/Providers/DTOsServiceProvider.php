<?php

namespace App\Providers;

use App\DTOs\Locations\LocationDTO;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class DTOsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(LocationDTO::class, fn ($app) => new LocationDTO());
    }
}
