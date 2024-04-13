<?php

namespace App\DTOs\Components\Filters\Partials;

use App\DTOs\BaseValidatedDTO;

class FilterRangeDTO extends BaseValidatedDTO
{
    public string $name;
    public int $minValue;
    public int $maxValue;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'minValue' => ['required', 'integer'],
            'maxValue' => ['required', 'integer'],
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
