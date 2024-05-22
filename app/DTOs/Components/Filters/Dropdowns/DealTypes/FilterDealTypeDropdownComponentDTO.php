<?php

namespace App\DTOs\Components\Filters\Dropdowns\DealTypes;

use App\DTOs\Components\Filters\Dropdowns\{BaseFilterSingleChoiceDropdownComponentDTO};
use App\DTOs\Filters\Items\FilterItemDTO;
use App\Enums\Filters\DealTypes;
use App\Enums\Filters\Queries;
use Spatie\TypeScriptTransformer\Attributes\RecordTypeScriptType;

/** @typescript */
class FilterDealTypeDropdownComponentDTO extends BaseFilterSingleChoiceDropdownComponentDTO
{
    #[RecordTypeScriptType(DealTypes::class, FilterItemDTO::class)]
    /** @var $items array{sale: FilterItemDTO, rent: FilterItemDTO} */
    public array $items;

    public function __construct(
        public DealTypes $dealType
    )
    {
        $this->dealType = $dealType;

        parent::__construct(
            dealType: $dealType,
            query: $this->getQuery(),
            defaultItem: $this->getDefaultItem(),
            items: $this->getItems()
        );
    }

    protected function getQuery(): Queries
    {
        return Queries::DEAL_TYPE;
    }

    protected function getDefaultItem(): FilterItemDTO
    {
        return new FilterItemDTO(
            name: trans('base.filter.deal_types.' . $this->dealType->value),
            value: $this->dealType->value
        );
    }

    protected function getItems(): array
    {
        $items = [];

        foreach (DealTypes::cases() as $dealType) {
            $items[$dealType->value] = new FilterItemDTO(
                name: trans('base.filter.deal_types.' . $dealType->value),
                value: $dealType->value
            );
        }

        return $items;
    }
}
