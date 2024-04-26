<?php

namespace App\DTOs\Components\Filters\Ranges;

use App\DTOs\BaseValidatedDTO;
use App\DTOs\Components\Filters\Partials\FilterInputDTO;
use App\DTOs\Components\Filters\Partials\FilterRangeDTO;
use App\Enums\Money\Currencies;
use App\Enums\Filters\{DealTypes};
use Illuminate\Support\Number;
use Illuminate\Validation\Rules\Enum;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

abstract class BaseFilterRangeComponentDTO extends BaseValidatedDTO
{
    public string $dealType;
    public string $minQueryName;
    public string $maxQueryName;
    /** @var array{min: string, max: string} */
    public array $queryNames;
    public ?FilterInputDTO $minQueryItem;
    public ?FilterInputDTO $maxQueryItem;
    /** @var array{min: FilterInputDTO, max: FilterInputDTO}|null */
    public ?array $queryItems;
    public FilterInputDTO $minDefaultItem;
    public FilterInputDTO $maxDefaultItem;
    /** @var array{min: FilterInputDTO, max: FilterInputDTO} */
    public array $defaultItems;
    // public FilterRangeGraphDTO $graph;
    /** @var array<FilterRangeDTO> */
    public array $items;

    protected function rules(): array
    {
        return [
            'dealType' => ['required', 'string', new Enum(DealTypes::class)],
        ];
    }

    protected function defaults(): array
    {
        return [
            'minQueryName' => $this->getMinQueryName(),
            'maxQueryName' => $this->getMaxQueryName(),
            'queryNames' => $this->getQueryNames(),
            'minQueryItem' => $this->getMinQueryItem(),
            'maxQueryItem' => $this->getMaxQueryItem(),
            'queryItems' => $this->getQueryItems(),
            'minDefaultItem' => $this->getMinDefaultItem(),
            'maxDefaultItem' => $this->getMaxDefaultItem(),
            'defaultItems' => $this->getDefaultItems(),
            'items' => $this->getItems(),
        ];
    }

    protected function casts(): array
    {
        return [];
    }

    /**
     * Get min and max query names
     *
     * @return array{min: string, max: string}
     */
    protected function getQueryNames(): array
    {
        return [
            'min' => $this->getMinQueryName(),
            'max' => $this->getMaxQueryName(),
        ];
    }

    /**
     * Get min and max query items
     *
     * @return array{min: FilterInputDTO, max: FilterInputDTO}|null
     */
    protected function getQueryItems(): ?array
    {
        $minQueryItem = $this->getMinQueryItem();
        $maxQueryItem = $this->getMaxQueryItem();

        if (empty($minQueryItem) || empty($maxQueryItem)) return null;

        return [
            'min' => $minQueryItem,
            'max' => $maxQueryItem,
        ];
    }

    /**
     * Get min and max query items
     *
     * @return array{min: FilterInputDTO, max: FilterInputDTO}
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
     * @return FilterInputDTO|null
     */
    protected function getMinQueryItem(): ?FilterInputDTO
    {
        return $this->getQueryItem(
            queryName: $this->getMinQueryName(),
        );
    }

    /**
     * Get max query item
     *
     * @return FilterInputDTO|null
     */
    protected function getMaxQueryItem(): ?FilterInputDTO
    {
        return $this->getQueryItem(
            queryName: $this->getMaxQueryName(),
        );
    }

    /**
     * Get query item
     *
     * @param string $queryName
     * @return FilterInputDTO|null
     */
    private function getQueryItem(string $queryName): ?FilterInputDTO
    {
        $queryValue = request()->query($queryName);

        if (!empty($queryValue)) {
            $queryValue = (int) $queryValue;
            $minDefaultValue = (int) $this->getMinDefaultItem()->value;
            $maxDefaultValue = (int) $this->getMaxDefaultItem()->value;
            $clampedValue = Number::clamp($queryValue, min: $minDefaultValue, max: $maxDefaultValue);

            return new FilterInputDTO([
                'name' => (string) $clampedValue,
                'value' => (string) $clampedValue
            ]);
        }

        return null;
    }

    /**
     * Get min query name
     *
     * @return string
     */
    abstract protected function getMinQueryName(): string;

    /**
     * Get max query name
     *
     * @return string
     */
    abstract protected function getMaxQueryName(): string;

    /**
     * Get min query item
     *
     * @return FilterInputDTO
     */
    abstract protected function getMinDefaultItem(): FilterInputDTO;

    /**
     * Get max query item
     *
     * @return FilterInputDTO
     */
    abstract protected function getMaxDefaultItem(): FilterInputDTO;

    /**
     * Get items
     *
     * @throws MissingCastTypeException
     * @throws CastTargetException
     * @return array<FilterRangeDTO>
     */
    abstract protected function getItems(): array;
}
