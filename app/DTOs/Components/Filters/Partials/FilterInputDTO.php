<?php

namespace App\DTOs\Components\Filters\Partials;

use App\DTOs\BaseDTO;

class FilterInputDTO extends BaseDTO
{
    public string $name;
    public string $value;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255'],
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
