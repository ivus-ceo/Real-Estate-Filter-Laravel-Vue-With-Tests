<?php

namespace App\DTOs\Pages\Public;

use App\DTOs\Components\{Filters\FilterComponentDTO, Filters\Partials\DealTypes\FilterDealTypeDropdownComponentDTO};
use Illuminate\Support\Facades\Route;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class HomePageDTO extends SimpleDTO
{
    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        $filterComponent = new FilterComponentDTO([
            'dealType' => FilterDealTypeDropdownComponentDTO::SALE,
        ]);

        return [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'filterComponent' => $filterComponent->toArray()
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
