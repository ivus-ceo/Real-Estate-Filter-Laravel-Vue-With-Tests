<?php

namespace App\DTOs\Components\Filters\Dropdowns;

use App\DTOs\BaseDTO;
use App\DTOs\Components\Filters\Partials\FilterInputDTO;
use App\Enums\Filters\DealTypes;
use Illuminate\Validation\Rules\Enum;

abstract class BaseFilterMultipleChoicesDropdownComponentDTO extends BaseDTO
{
    public string $dealType;
    public string $queryName;
    /** @var array<FilterInputDTO>|null */
    public ?array $queryItems;
    /** @var array<FilterInputDTO> */
    public array $defaultItems;
    /** @var array<FilterInputDTO> */
    public array $items;

    protected function rules(): array
    {
        return [
            'dealType' => ['required', 'string', new Enum(DealTypes::class)],
        ];
    }

    /**
     * Returns the default values
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @return array
     */
    protected function defaults(): array
    {
        return [
            'queryName' => $this->getQueryName(),
            'queryItems' => $this->getQueryItems(),
            'defaultItems' => $this->getDefaultItems(),
            'items' => $this->getItems(),
        ];
    }

    /**
     * Casts the data
     *
     * @return array
     */
    protected function casts(): array
    {
        return [];
    }

    /**
     * Returns the query item
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @return array<FilterInputDTO>|null
     */
    protected function getQueryItems(): ?array
    {
        $queryName = $this->getQueryName();
        $queryValues = request()->query($queryName);
        $items = [];

        if (!empty($queryValues) && is_array($queryValues)) {
            foreach ($queryValues as $value) {
                /** @var FilterInputDTO $item */
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
     * @return string
     */
    abstract protected function getQueryName(): string;

    /**
     * Returns the default item
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @return array<FilterInputDTO>
     */
    abstract protected function getDefaultItems(): array;

    /**
     * Returns the all items
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @return array<FilterInputDTO>
     */
    abstract protected function getItems(): array;
}
