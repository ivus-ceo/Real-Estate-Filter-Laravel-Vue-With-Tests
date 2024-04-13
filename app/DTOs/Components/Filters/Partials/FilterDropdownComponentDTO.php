<?php

namespace App\DTOs\Components\Filters\Partials;

use App\DTOs\BaseValidatedDTO;

abstract class FilterDropdownComponentDTO extends BaseValidatedDTO
{
    public string $query;
    public array $items;
    public FilterInputDTO $default;

    protected function rules(): array
    {
        return [];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }

    abstract protected function getQuery(): string;
    abstract protected function getItems(): array;
    abstract protected function getDefault(): FilterInputDTO;
}
