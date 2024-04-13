<?php

namespace App\DTOs\Pages\Public;

use App\Enums\Filters\DealTypes;
use App\DTOs\Components\Filters\{FilterComponentDTO, Partials\DealTypes\FilterDealTypeDropdownComponentDTO};
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class SalePropertyPageDTO extends SimpleDTO
{
    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        $filterComponent = new FilterComponentDTO([
            'dealType' => DealTypes::SALE,
        ]);

        return [
            'filterComponent' => $filterComponent->toArray()
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
