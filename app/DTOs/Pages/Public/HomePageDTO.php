<?php

namespace App\DTOs\Pages\Public;

use App\DTOs\BaseDTO;
use Illuminate\Support\Facades\Route;

class HomePageDTO extends BaseDTO
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
