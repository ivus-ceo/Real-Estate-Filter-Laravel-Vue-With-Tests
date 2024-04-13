<?php

namespace App\DTOs\Components\Filters\Partials;

use App\DTOs\BaseValidatedDTO;

class FilterRangeGraphDTO extends BaseValidatedDTO
{
    public int $min;
    public int $max;
    public array $items;

    protected function rules(): array
    {
        return [
            'min' => ['required', 'integer'],
            'max' => ['required', 'integer'],
            'items' => ['required', 'array'],
            'items.*' => ['integer'],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
