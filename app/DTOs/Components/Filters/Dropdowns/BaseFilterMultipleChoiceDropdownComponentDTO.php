<?php

namespace App\DTOs\Components\Filters\Dropdowns;

use App\DTOs\BaseDTO;
use App\DTOs\Filters\Items\FilterItemDTO;
use App\Enums\Filters\DealTypes;
use App\Enums\Filters\Queries;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\RecordTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

abstract class BaseFilterMultipleChoiceDropdownComponentDTO extends BaseDTO
{
    #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterItemDTO[] | null')]
    public ?array $queryItems;

    /**
     * @param DealTypes $dealType
     * @param Queries $query
     * @param array<FilterItemDTO> $defaultItems
     * @param array<FilterItemDTO> $items
     */
    public function __construct(
        public DealTypes $dealType,
        public Queries $query,
        #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterItemDTO[]')]
        public array $defaultItems,
        public array $items
    )
    {
        $this->queryItems = $this->getQueryItems();
    }

    /**
     * Returns the query item
     *
     * @return array<FilterItemDTO>|null
     */
    protected function getQueryItems(): ?array
    {
        $query = $this->getQuery();
        $queryValues = request()->query($query->value);
        $items = [];

        if (!empty($queryValues) && is_array($queryValues)) {
            foreach ($queryValues as $value) {
                foreach ($this->getItems() as $item) {
                    if ($item->value !== $value) continue;

                    $items[] = $item;
                }
            }

            return $items;
        }

        return null;
    }

    /**
     * Returns the query string
     *
     * @return Queries
     */
    abstract protected function getQuery(): Queries;

    /**
     * Returns the default item
     *
     * @return array<FilterItemDTO>
     */
    abstract protected function getDefaultItems(): array;

    /**
     * Returns the all items
     *
     * @return array<FilterItemDTO>
     */
    abstract protected function getItems(): array;
}
