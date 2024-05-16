<?php

namespace App\DTOs\Components\Filters\Dropdowns;

use App\DTOs\BaseDTO;
use App\DTOs\Filters\Items\FilterItem;
use App\Enums\Filters\DealTypes;
use App\Enums\Filters\Queries;

abstract class BaseFilterSingleChoiceDropdownComponentDTO extends BaseDTO
{
    /**
     * @param DealTypes $dealType
     * @param Queries $query
     * @param FilterItem|null $queryItem
     * @param FilterItem $defaultItem
     * @param array $items
     */
    public function __construct(
        public DealTypes $dealType,
        public Queries $query,
        public ?FilterItem $queryItem,
        public FilterItem $defaultItem,
        public array $items
    )
    {}

    /**
     * Returns the query item
     *
     * @return FilterItem|null
     */
    protected function getQueryItem(): ?FilterItem
    {
        $query = $this->getQuery();
        $queryValue = request()->query($query->value);

        if (!empty($queryValue)) {
            foreach ($this->getItems() as $element) {
                if ($element->value !== $queryValue)
                    continue;

                return $element;
            }
        }

        return null;
    }

    /**
     * Returns the query
     *
     * @return Queries
     */
    abstract protected function getQuery(): Queries;

    /**
     * Returns the default item
     *
     * @return FilterItem
     */
    abstract protected function getDefaultItem(): FilterItem;

    /**
     * Returns the all items
     *
     * @return array<FilterItem>
     */
    abstract protected function getItems(): array;
}
