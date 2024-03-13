<?php

namespace App\DTOs\Pages;

use App\DTOs\Components\{FilterComponentDTO};
use Illuminate\Support\Facades\Route;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class HomePageDTO extends SimpleDTO
{
    protected function defaults(): array
    {
        $filterComponentDTO = app(FilterComponentDTO::class);

        return [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'filter_component' => $filterComponentDTO->toArray()
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
