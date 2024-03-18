<?php

namespace App\DTOs\Filters;

use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FilterDTO extends ValidatedDTO
{
    public string $dealType;

    public const DEAL_TYPES = ['sale', 'rent'];
    public const ROOMS = ['1', '2', '3', '4'];
    public const ROOM_PRICES = [
        ':50000000',
        '50000000:70000000',
        '70000000:100000000',
        '100000000:120000000',
        '120000000:',
    ];

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
