<?php

namespace App\DTOs\Pages;

use Illuminate\Support\Facades\Route;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class HomePageDTO extends SimpleDTO
{
    protected function defaults(): array
    {
        return [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
