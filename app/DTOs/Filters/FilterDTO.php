<?php

namespace App\DTOs\Filters;

use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FilterDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
//            'deal_type' => ['required', Rule::in(self::DEAL_TYPES)],
//            'roominess' => ['nullable', Rule::in(self::ROOMS)],
//            'prices' => ['nullable', Rule::in(self::PRICES)],
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
