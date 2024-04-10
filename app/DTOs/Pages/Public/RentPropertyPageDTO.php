<?php

namespace App\DTOs\Pages\Public;

use App\DTOs\Components\Filters\{FilterComponentDTO, FilterSaleComponentDTO};
use WendellAdriel\ValidatedDTO\SimpleDTO;

class RentPropertyPageDTO extends SimpleDTO
{
    protected function defaults(): array
    {
        $filterComponentDTO = app(FilterSaleComponentDTO::class);

        return [
            'filter_component' => $filterComponentDTO->toArray()
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
