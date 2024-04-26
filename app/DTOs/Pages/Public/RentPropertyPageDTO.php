<?php

namespace App\DTOs\Pages\Public;

use App\DTOs\BaseSimpleDTO;
use App\Enums\Filters\DealTypes;
use App\DTOs\Components\Filters\{FilterComponentDTO};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};

class RentPropertyPageDTO extends BaseSimpleDTO
{
    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        $filterComponent = new FilterComponentDTO([
            'dealType' => DealTypes::RENT,
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
