<?php

namespace App\DTOs\Components\Filters\Dropdowns\Roominess;

use App\Enums\Filters\Queries;
use App\Enums\Filters\Roominess;
use App\DTOs\Components\Filters\Dropdowns\{BaseFilterMultipleChoicesDropdownComponentDTO};
use App\DTOs\Components\Filters\Partials\{FilterInputDTO};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};
use Illuminate\Support\Str;

class FilterRoominessDropdownComponentDTO extends BaseFilterMultipleChoicesDropdownComponentDTO
{
    /** @var array<FilterInputDTO> */
    public array $items;

    public function getQueryName(): string
    {
        return Queries::ROOMINESS->value;
    }

    public function getDefaultItems(): array
    {
        return [
            new FilterInputDTO([
                'name' => trans('base.filter.rooms.any'),
                'value' => 'any'
            ])
        ];
    }

    /**
     * @throws MissingCastTypeException
     * @throws CastTargetException
     * @return array<FilterInputDTO>
     */
    public function getItems(): array
    {
        $items = [
            new FilterInputDTO([
                'name' => trans('base.filter.rooms.any'),
                'value' => 'any',
            ])
        ];

        foreach (Roominess::cases() as $i => $room) {
            $value = $room->value;

            // If it's the last item
            if ($i === count(Roominess::cases()) - 1) {
                $value .= ':';
            }

            $items[] = new FilterInputDTO([
                'name' => trans('base.filter.rooms.' . Str::lower($room->name)),
                'value' => (string) $value,
            ]);
        }

        return $items;
    }
}
