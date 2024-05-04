<?php

namespace App\DTOs\Components\Filters\Partials;

use App\DTOs\BaseDTO;

class FilterRangeDTO extends BaseDTO
{
    public string $name;
    public array | FilterInputDTO $minValue;
    public array | FilterInputDTO $maxValue;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'minValue' => ['required'],
            'maxValue' => ['required'],
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
