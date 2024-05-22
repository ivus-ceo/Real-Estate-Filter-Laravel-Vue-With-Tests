<?php

namespace App\DTOs\Components\Filters\Searches;

use App\DTOs\BaseDTO;
use App\DTOs\Filters\Items\{FilterItemDTO, FilterListDTO};
use App\Enums\Filters\Queries;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
abstract class BaseFilterSearchComponentDTO extends BaseDTO
{
    public ?FilterItemDTO $queryItem;

    /**
     * @param Queries $query
     * @param FilterItemDTO $defaultItem
     * @param array<FilterListDTO> $items
     */
    public function __construct(
        public Queries       $query,
        public FilterItemDTO $defaultItem,
        #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterList[]')]
        public array         $items,
    )
    {
        $this->queryItem = $this->getQueryItem();
    }

    /**
     * Get query item
     *
     * @return FilterItemDTO|null
     */
    protected function getQueryItem(): ?FilterItemDTO
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
     * @return FilterItemDTO
     */
    abstract protected function getDefaultItem(): FilterItemDTO;

    /**
     * Get items
     *
     * @return array<FilterListDTO>
     */
    abstract protected function getItems(): array;
}
