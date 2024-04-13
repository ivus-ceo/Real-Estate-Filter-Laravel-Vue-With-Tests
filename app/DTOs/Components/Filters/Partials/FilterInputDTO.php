<?php

namespace App\DTOs\Components\Filters\Partials;

use App\Rules\Filters\FilterDefaultInputable;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FilterInputDTO extends ValidatedDTO
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
