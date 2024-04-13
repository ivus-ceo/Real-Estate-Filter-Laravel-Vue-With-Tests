<?php

namespace App\DTOs\Components\Filters\Partials\DealTypes;

use App\Enums\Filters\DealTypes;
use Illuminate\Validation\Rule;
use App\DTOs\Components\Filters\FilterComponentDTO;
use App\DTOs\Components\Filters\Partials\{
    FilterDropdownComponentDTO,
    FilterInputDTO
};
use Illuminate\Validation\Rules\{Enum};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};

class FilterDealTypeDropdownComponentDTO extends FilterDropdownComponentDTO
{
    public string $dealType;
    /** @var array{sale: FilterInputDTO, rent: FilterInputDTO} */
    public array $items;

    protected function rules(): array
    {
        return [
            'dealType' => ['required', 'string', new Enum(DealTypes::class)]
        ];
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        return [
            'query' => $this->getQuery(),
            'items' => $this->getItems(),
            'default' => $this->getDefault()
        ];
    }

    protected function getQuery(): string
    {
        return 'dealType';
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @return array{sale: FilterInputDTO, rent: FilterInputDTO}
     */
    protected function getItems(): array
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

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function getDefault(): FilterInputDTO
    {
        return new FilterInputDTO([
            'name' => trans('base.filter.deal_types.' . $this->dealType),
            'value' => $this->dealType
        ]);
    }
}
