<?php

namespace App\DTOs\Components\Filters\Dropdowns\Roominess;

use App\Enums\Filters\DealTypes;
use App\DTOs\Components\Filters\Dropdowns\{BaseFilterMultipleChoiceDropdownComponentDTO};
use App\DTOs\Filters\Items\FilterItemDTO;
use App\Enums\Filters\Queries;
use App\Enums\Filters\Roominess;
use Illuminate\Support\Str;
use Spatie\TypeScriptTransformer\Attributes\RecordTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

/** @typescript */
class FilterRoominessDropdownComponentDTO extends BaseFilterMultipleChoiceDropdownComponentDTO
{
    #[RecordTypeScriptType(Roominess::class, FilterItemDTO::class)]
    /** @var $items array<FilterItemDTO> */
    public array $items;

    public function __construct(
        public DealTypes $dealType,
    )
    {
        parent::__construct(
            dealType: $dealType,
            query: $this->getQuery(),
            defaultItems: $this->getDefaultItems(),
            items: $this->getItems()
        );
    }

    public function getQuery(): Queries
    {
        return Queries::ROOMINESS;
    }

    public function getDefaultItems(): array
    {
        return [
            new FilterItemDTO(
                name: trans('base.filter.rooms.any'),
                value: 'any'
            )
        ];
    }

    public function getItems(): array
    {
        $items = [
            new FilterItemDTO(
                name: trans('base.filter.rooms.any'),
                value: 'any',
            )
        ];

        foreach (Roominess::cases() as $i => $room) {
            $value = $room->value;

            // If it's the last item
            if ($i === count(Roominess::cases()) - 1) {
                $value .= ':';
            }

            $items[] = new FilterItemDTO(
                name: trans('base.filter.rooms.' . Str::lower($room->name)),
                value: (string) $value,
            );
        }

        return $items;
    }
}
