<?php

namespace App\DTOs\Components\Filters\Dropdowns\DealTypes;

use App\DTOs\Components\Filters\Dropdowns\{BaseFilterDropdownComponentDTO};
use App\DTOs\Components\Filters\Partials\{FilterInputDTO};
use App\Enums\Filters\DealTypes;
use App\Enums\Filters\Queries;
use Illuminate\Validation\Rules\{Enum};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};

class FilterDealTypeDropdownComponentDTO extends BaseFilterDropdownComponentDTO
{
    public string $dealType;
    /** @var array{sale: FilterInputDTO, rent: FilterInputDTO} */
    public array $items;

    public function getQueryName(): string
    {
        return Queries::DEAL_TYPE->value;
    }

    public function getDefaultItem(): FilterInputDTO
    {
        return new FilterInputDTO([
            'name' => trans('base.filter.deal_types.' . $this->dealType),
            'value' => $this->dealType
        ]);
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @return array{sale: FilterInputDTO, rent: FilterInputDTO}
     */
    public function getItems(): array
    {
        $items = [];

        foreach (DealTypes::cases() as $dealType) {
            $items[$dealType->value] = new FilterInputDTO([
                'name' => trans('base.filter.deal_types.' . $dealType->value),
                'value' => $dealType
            ]);
        }

        return $items;
    }
}
