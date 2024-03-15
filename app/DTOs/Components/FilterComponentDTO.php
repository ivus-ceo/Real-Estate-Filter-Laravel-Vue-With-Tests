<?php

namespace App\DTOs\Components;

use App\DTOs\Filters\FilterDTO;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class FilterComponentDTO extends SimpleDTO
{
    protected function defaults(): array
    {
        return [
            'deal_types' => FilterDTO::DEAL_TYPES,
            'rooms' => FilterDTO::ROOMS,
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
