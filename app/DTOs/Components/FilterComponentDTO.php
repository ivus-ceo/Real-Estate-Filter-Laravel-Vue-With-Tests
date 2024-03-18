<?php

namespace App\DTOs\Components;

use App\DTOs\Filters\FilterDTO;
use Illuminate\Support\Collection;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class FilterComponentDTO extends SimpleDTO
{
    protected function defaults(): array
    {
        return [
            'deal_types' => $this->getDealTypes(),
            'rooms' => $this->getRooms(),
            'prices' => FilterDTO::ROOM_PRICES,
        ];
    }

    protected function casts(): array
    {
        return [];
    }

    private function getDealTypes(): Collection
    {
        return collect(FilterDTO::DEAL_TYPES)
            ->transform(function (string $dealType) {
                return [
                    'name' => trans('base.deal_types.' . $dealType),
                    'value' => $dealType
                ];
            });
    }

    private function getRooms(): Collection
    {
        return collect(FilterDTO::ROOMS)
            ->transform(function (string $room) {
                return [
                    'name' => $room,
                    'value' => ($room === '4') ? '4:' : $room
                ];
            });
    }
}
