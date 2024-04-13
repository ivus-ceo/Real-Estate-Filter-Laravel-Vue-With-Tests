<?php

namespace App\DTOs\Components\Filters\Partials;

use App\DTOs\BaseValidatedDTO;

abstract class FilterRangeComponentDTO extends BaseValidatedDTO
{
    public string $query;
    public FilterRangeDTO $current;
    public FilterRangeDTO $default;
    public array $items;

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
    abstract protected function getCurrent(): FilterRangeDTO;
    abstract protected function getDefault(): FilterRangeDTO;
    abstract protected function getItems(): array;
}
