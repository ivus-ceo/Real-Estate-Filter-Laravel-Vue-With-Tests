<?php

namespace App\DTOs\Pages\Public;

use App\DTOs\Components\{Filters\Dropdowns\DealTypes\FilterDealTypeDropdownComponentDTO, Filters\FilterComponentDTO};
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
