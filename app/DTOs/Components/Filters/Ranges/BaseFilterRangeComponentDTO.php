<?php

namespace App\DTOs\Components\Filters\Ranges;

use App\DTOs\BaseDTO;
use App\DTOs\Components\Filters\Ranges\Graphs\BaseRangeGraphComponentDTO;
use App\DTOs\Filters\Items\{FilterItemDTO, FilterRangeDTO};
use App\Enums\Filters\{DealTypes, Queries};
use Illuminate\Support\Number;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
abstract class BaseFilterRangeComponentDTO extends BaseDTO
{
    public ?FilterItemDTO $minQueryItem;
    public ?FilterItemDTO $maxQueryItem;
    #[LiteralTypeScriptType('{min: App.Enums.Filters.Queries, max: App.Enums.Filters.Queries}')]
    /** @var $queries array{min: Queries, max: Queries} */
    public array $queries;
    #[LiteralTypeScriptType('{min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO}')]
    /** @var $defaultItems array{min: FilterItemDTO, max: FilterItemDTO} */
    public array $defaultItems;
    #[LiteralTypeScriptType('{min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO} | null')]
    /** @var $queryItems array{min: FilterItemDTO, max: FilterItemDTO}|null */
    public ?array $queryItems;

    /**
     * @param Queries $minQuery
     * @param Queries $maxQuery
     * @param FilterItemDTO $minDefaultItem
     * @param FilterItemDTO $maxDefaultItem
     * @param BaseRangeGraphComponentDTO $graph
     * @param array<FilterRangeDTO> $items
     */
    public function __construct(
        public Queries                    $minQuery,
        public Queries                    $maxQuery,
        public FilterItemDTO              $minDefaultItem,
        public FilterItemDTO              $maxDefaultItem,
        public BaseRangeGraphComponentDTO $graph,
        #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterRangeDTO[]')]
        public array                      $items,
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
     * @return array{min: FilterItemDTO, max: FilterItemDTO}|null
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
     * @return array{min: FilterItemDTO, max: FilterItemDTO}
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
     * @return FilterItemDTO|null
     */
    protected function getMinQueryItem(): ?FilterItemDTO
    {
        return $this->getQueryItem(
            query: $this->getMinQuery(),
        );
    }

    /**
     * Get max query item
     *
     * @return FilterItemDTO|null
     */
    protected function getMaxQueryItem(): ?FilterItemDTO
    {
        return $this->getQueryItem(
            query: $this->getMaxQuery(),
        );
    }

    /**
     * Get query item
     *
     * @param Queries $query
     * @return FilterItemDTO|null
     */
    private function getQueryItem(Queries $query): ?FilterItemDTO
    {
        $queryName = $query->value;
        $queryValue = request()->query($queryName);

        if (!empty($queryValue)) {
            $queryValue = (int) $queryValue;
            $minDefaultValue = (int) $this->getMinDefaultItem()->value;
            $maxDefaultValue = (int) $this->getMaxDefaultItem()->value;
            $clampedValue = Number::clamp($queryValue, min: $minDefaultValue, max: $maxDefaultValue);

            return new FilterItemDTO(
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
     * @return FilterItemDTO
     */
    abstract protected function getMinDefaultItem(): FilterItemDTO;

    /**
     * Get max query item
     *
     * @return FilterItemDTO
     */
    abstract protected function getMaxDefaultItem(): FilterItemDTO;

    /**
     * Get items
     *
     * @return array<FilterRangeDTO>
     */
    abstract protected function getItems(): array;

    /**
     * Get graph
     *
     * @return BaseRangeGraphComponentDTO
     */
    abstract protected function getGraph(): BaseRangeGraphComponentDTO;
}
