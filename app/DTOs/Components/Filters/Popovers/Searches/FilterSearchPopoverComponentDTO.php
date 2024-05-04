<?php

namespace App\DTOs\Components\Filters\Popovers\Searches;

use App\DTOs\Components\Filters\Popovers\BaseFilterPopoverComponentDTO;
use App\DTOs\Components\Filters\Dropdowns\{BaseFilterDropdownComponentDTO};
use App\DTOs\Components\Filters\Partials\{FilterInputDTO, FilterListDTO};
use App\Enums\Filters\DealTypes;
use App\Enums\Filters\Queries;
use Illuminate\Validation\Rules\{Enum};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};

class FilterSearchPopoverComponentDTO extends BaseFilterPopoverComponentDTO
{
    /** @var array<FilterListDTO> */
    public array $items;

    protected function getQueryName(): string
    {
        return Queries::SEARCH->value;
    }

    protected function getDefaultItem(): string
    {
        // TODO: Implement getDefaultItem() method.
    }

    protected function getItems(): array
    {
        // TODO: Implement getItems() method.
    }
}
