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
            'roominess' => $this->getRoominess(),
            'prices' => $this->getPrices(),
            'areas' => $this->getAreas(),
        ];
    }

    protected function casts(): array
    {
        return [];
    }

    private function getDealTypes(): Collection
    {
        $queryDealType = request()->query('deal_type');

        return collect(FilterDTO::DEAL_TYPES)
            ->transform(function (string $dealType) use ($queryDealType) {
                $existsInQuery = $queryDealType === $dealType;

                return [
                    'name' => trans('base.filter.deal_types.' . $dealType),
                    'value' => $dealType,
                    'exists_in_query' => $existsInQuery
                ];
            })
            ->push([
                'name' => trans('base.filter.deal_types.all'),
                'value' => '',
                'exists_in_query' => !in_array($queryDealType, FilterDTO::DEAL_TYPES)
            ])
            ->sortBy('value')
            ->values();
    }

    private function getRoominess(): Collection
    {
        $queryRoominess = request()->query('roominess');

        return collect(FilterDTO::ROOMS)
            ->transform(function (string $room) use ($queryRoominess) {
                $isFirst = $room === '0';
                $isLast = $room === '4';

                if ($isFirst) {
                    $value = $room;
                } else if ($isLast) {
                    $value = '4:';
                } else {
                    $value = $room;
                }

                return [
                    'name' => trans('base.filter.rooms.' . $room),
                    'value' => $value,
                    'exists_in_query' => $queryRoominess === $value
                ];
            })
            ->push([
                'name' => trans('base.filter.rooms.all'),
                'value' => '',
                'exists_in_query' => !in_array($queryRoominess, FilterDTO::ROOMS)
            ]);
    }

    private function getPrices(): Collection
    {
        return collect(FilterDTO::PRICES)
            ->transform(function (string $price) {
                $prices = explode(':', $price);
                $from = $prices[0];
                $to = $prices[1];

                return [
                    'name' => $price,
                    'value' => $price
                ];
            });
    }

    private function getAreas(): Collection
    {
        return collect(FilterDTO::AREAS)
            ->transform(function (string $area) {
                $areas = explode(':', $area);
                $from = $areas[0];
                $to = $areas[1];

                return [
                    'name' => $area,
                    'value' => $area
                ];
            });
    }
}
