<?php

namespace App\DTOs\Components\Filters\Partials;

use App\DTOs\BaseValidatedDTO;

class FilterListDTO extends BaseValidatedDTO
{
    public string $queryName;
    public string $name;
    public array $items;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
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
