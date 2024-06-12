<?php

namespace App\Providers;

use App\Repositories\{BaseRepositoryInterface, BaseRepository};
use App\Repositories\Countries\{CountryRepositoryInterface, CountryRepository};
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
    }
}
