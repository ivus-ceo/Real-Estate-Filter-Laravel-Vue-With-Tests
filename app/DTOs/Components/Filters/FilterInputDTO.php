<?php

namespace App\DTOs\Components\Filters;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FilterInputDTO extends ValidatedDTO
{
    public string $name;
    public string $value;
    public bool $default;

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
