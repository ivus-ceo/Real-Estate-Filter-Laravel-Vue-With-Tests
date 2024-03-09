<?php

namespace App\Services\Pages;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class HomePageService
{
    public function index(): array
    {
        return [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ];
    }
}
