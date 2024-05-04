<?php

namespace App\DTOs\Components\Filters\Popovers;

use App\DTOs\BaseDTO;
use App\DTOs\Components\Filters\Partials\FilterInputDTO;
use App\DTOs\Components\Filters\Partials\FilterListDTO;
use App\Enums\Filters\DealTypes;
use Illuminate\Validation\Rules\Enum;

abstract class BaseFilterPopoverComponentDTO extends BaseDTO
{
    public string $dealType;
    public string $queryName;
    public string $queryItem;
    public string $defaultItem;
    /** @var array<FilterListDTO> */
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
            'queryItem' => $this->getQueryItem(),
            'defaultItem' => $this->getDefaultItem(),
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
     * @return string|null
     */
    protected function getQueryItem(): ?string
    {
        $queryName = $this->getQueryName();
        $queryValue = request()->query($queryName);

        if (!empty($queryValue)) {
            /** @var FilterInputDTO $item */
            foreach ($this->getItems() as $item) {
                if ($item->value !== $queryValue) continue;

                return $item;
            }
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
     * @return string
     */
    abstract protected function getDefaultItem(): string;

    /**
     * Returns the all items
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @return array<FilterListDTO>
     */
    abstract protected function getItems(): array;
}
