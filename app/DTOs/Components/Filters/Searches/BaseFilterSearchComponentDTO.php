<?php

namespace App\DTOs\Components\Filters\Searches;

use App\DTOs\BaseDTO;
use App\DTOs\Filters\Items\{FilterItem, FilterList};
use App\Enums\Filters\Queries;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
abstract class BaseFilterSearchComponentDTO extends BaseDTO
{
    public ?FilterItem $queryItem;

    /**
     * @param Queries $query
     * @param FilterItem $defaultItem
     * @param array<FilterList> $items
     */
    public function __construct(
        public Queries $query,
        public FilterItem $defaultItem,
        #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterList[]')]
        public array $items,
    )
    {
        $this->queryItem = $this->getQueryItem();
    }

    /**
     * Get query item
     *
     * @return FilterItem|null
     */
    protected function getQueryItem(): ?FilterItem
    {
        return null;
    }

    /**
     * Get query
     *
     * @return Queries
     */
    abstract protected function getQuery(): Queries;

    /**
     * Get default item
     *
     * @return FilterItem
     */
    abstract protected function getDefaultItem(): FilterItem;

    /**
     * Get items
     *
     * @return array<FilterList>
     */
    abstract protected function getItems(): array;
}
