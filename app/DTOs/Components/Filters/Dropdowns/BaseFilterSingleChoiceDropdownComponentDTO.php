<?php

namespace App\DTOs\Components\Filters\Dropdowns;

use App\DTOs\BaseDTO;
use App\DTOs\Filters\Items\FilterItemDTO;
use App\Enums\Filters\DealTypes;
use App\Enums\Filters\Queries;

/** @typescript */
abstract class BaseFilterSingleChoiceDropdownComponentDTO extends BaseDTO
{
    public ?FilterItemDTO $queryItem;

    /**
     * @param DealTypes $dealType
     * @param Queries $query
     * @param FilterItemDTO $defaultItem
     * @param array $items
     */
    public function __construct(
        public DealTypes     $dealType,
        public Queries       $query,
        public FilterItemDTO $defaultItem,
        public array         $items
    )
    {
        $this->queryItem = $this->getQueryItem();
    }

    /**
     * Returns the query item
     *
     * @return FilterItemDTO|null
     */
    protected function getQueryItem(): ?FilterItemDTO
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
     * @return FilterItemDTO
     */
    abstract protected function getDefaultItem(): FilterItemDTO;

    /**
     * Returns the all items
     *
     * @return array<FilterItemDTO>
     */
    abstract protected function getItems(): array;
}
