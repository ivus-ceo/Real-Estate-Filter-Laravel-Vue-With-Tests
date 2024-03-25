<?php

namespace App\DTOs\Pages;

use App\DTOs\Components\{FilterComponentDTO};
use Illuminate\Support\Facades\Route;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class FilterPageDTO extends SimpleDTO
{
    protected function defaults(): array
    {
        $filterComponentDTO = app(FilterComponentDTO::class);

        return [
            'filter_component' => $filterComponentDTO->toArray()
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
