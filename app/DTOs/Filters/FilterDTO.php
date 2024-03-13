<?php

namespace App\DTOs\Filters;

use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FilterDTO extends ValidatedDTO
{
    public string $dealType;

    protected const DEAL_TYPES = ['rent', 'sale'];

    protected function rules(): array
    {
        return [
            'deal_type' => ['required', Rule::in(self::DEAL_TYPES)],
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
