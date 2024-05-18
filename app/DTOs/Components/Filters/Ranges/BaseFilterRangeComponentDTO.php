<?php

namespace App\DTOs\Components\Filters\Ranges;

use App\DTOs\BaseDTO;
use App\DTOs\Components\Filters\Ranges\Graphs\BaseRangeGraphComponent;
use App\DTOs\Filters\Items\{FilterItem, FilterRange};
use App\Enums\Filters\{DealTypes, Queries};
use Illuminate\Support\Number;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
abstract class BaseFilterRangeComponentDTO extends BaseDTO
{
    public ?FilterItem $minQueryItem;
    public ?FilterItem $maxQueryItem;
    #[LiteralTypeScriptType('{min: App.Enums.Filters.Queries, max: App.Enums.Filters.Queries}')]
    /** @var $queries array{min: Queries, max: Queries} */
    public array $queries;
    #[LiteralTypeScriptType('{min: App.DTOs.Filters.Items.FilterItem, max: App.DTOs.Filters.Items.FilterItem}')]
    /** @var $defaultItems array{min: FilterItem, max: FilterItem} */
    public array $defaultItems;
    #[LiteralTypeScriptType('{min: App.DTOs.Filters.Items.FilterItem, max: App.DTOs.Filters.Items.FilterItem} | null')]
    /** @var $queryItems array{min: FilterItem, max: FilterItem}|null */
    public ?array $queryItems;

    /**
     * @param Queries $minQuery
     * @param Queries $maxQuery
     * @param FilterItem $minDefaultItem
     * @param FilterItem $maxDefaultItem
     * @param BaseRangeGraphComponent $graph
     * @param array<FilterRange> $items
     */
    public function __construct(
        public Queries $minQuery,
        public Queries $maxQuery,
        public FilterItem $minDefaultItem,
        public FilterItem $maxDefaultItem,
        public BaseRangeGraphComponent $graph,
        #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterRange[]')]
        public array $items,
    )
    {
        $this->minQueryItem = $this->getMinQueryItem();
        $this->maxQueryItem = $this->getMaxQueryItem();
        $this->queries = $this->getQueries();
        $this->defaultItems = $this->getDefaultItems();
        $this->queryItems = $this->getQueryItems();
    }

    /**
     * Get min and max query names
     *
     * @return array{min: string, max: string}
     */
    protected function getQueries(): array
    {
        return [
            'min' => $this->getMinQuery(),
            'max' => $this->getMaxQuery(),
        ];
    }

    /**
     * Get min and max query items
     *
     * @return array{min: FilterItem, max: FilterItem}|null
     */
    protected function getQueryItems(): ?array
    {
        if (empty($this->minQueryItem) && empty($this->maxQueryItem)) return null;

        return [
            'min' => !empty($this->minQueryItem) ? $this->minQueryItem : null,
            'max' => !empty($this->maxQueryItem) ? $this->maxQueryItem : null,
        ];
    }

    /**
     * Get min and max query items
     *
     * @return array{min: FilterItem, max: FilterItem}
     */
    protected function getDefaultItems(): array
    {
        return [
            'min' => $this->getMinDefaultItem(),
            'max' => $this->getMaxDefaultItem(),
        ];
    }

    /**
     * Get min query item
     *
     * @return FilterItem|null
     */
    protected function getMinQueryItem(): ?FilterItem
    {
        return $this->getQueryItem(
            query: $this->getMinQuery(),
        );
    }

    /**
     * Get max query item
     *
     * @return FilterItem|null
     */
    protected function getMaxQueryItem(): ?FilterItem
    {
        return $this->getQueryItem(
            query: $this->getMaxQuery(),
        );
    }

    /**
     * Get query item
     *
     * @param Queries $query
     * @return FilterItem|null
     */
    private function getQueryItem(Queries $query): ?FilterItem
    {
        $queryName = $query->value;
        $queryValue = request()->query($queryName);

        if (!empty($queryValue)) {
            $queryValue = (int) $queryValue;
            $minDefaultValue = (int) $this->getMinDefaultItem()->value;
            $maxDefaultValue = (int) $this->getMaxDefaultItem()->value;
            $clampedValue = Number::clamp($queryValue, min: $minDefaultValue, max: $maxDefaultValue);

            return new FilterItem(
                name: (string) $clampedValue,
                value: (string) $clampedValue
            );
        }

        return null;
    }

    /**
     * Get min query
     *
     * @return Queries
     */
    abstract protected function getMinQuery(): Queries;

    /**
     * Get max query
     *
     * @return Queries
     */
    abstract protected function getMaxQuery(): Queries;

    /**
     * Get min query item
     *
     * @return FilterItem
     */
    abstract protected function getMinDefaultItem(): FilterItem;

    /**
     * Get max query item
     *
     * @return FilterItem
     */
    abstract protected function getMaxDefaultItem(): FilterItem;

    /**
     * Get items
     *
     * @return array<FilterRange>
     */
    abstract protected function getItems(): array;

    /**
     * Get graph
     *
     * @return BaseRangeGraphComponent
     */
    abstract protected function getGraph(): BaseRangeGraphComponent;
}
