<?php

namespace App\DTOs\Components\Filters\Searches\Search;

use App\DTOs\Components\Filters\Searches\BaseFilterSearchComponentDTO;
use App\DTOs\Filters\Items\FilterItem;
use App\DTOs\Filters\Items\FilterList;
use App\Models\{Finishing, Room, Building};
use App\Enums\Filters\{DealTypes, Queries};

/** @typescript */
class FilterSearchComponentDTO extends BaseFilterSearchComponentDTO
{
    public function __construct(
        DealTypes $dealType = null,
    )
    {
        parent::__construct(
            query: $this->getQuery(),
            defaultItem: $this->getDefaultItem(),
            items: $this->getItems(),
        );
    }

    protected function getQuery(): Queries
    {
        return Queries::SEARCH;
    }

    protected function getDefaultItem(): FilterItem
    {
        return new FilterItem(
            name: trans('base.filter.search_placeholder'),
            value: '',
        );
    }

    protected function getItems(): array
    {
        $items = [];
        // TODO: Get from data from current page, example from selection
        $buildings = Building::limit(20)->inRandomOrder()->get();
        $finishings = Finishing::get();
        $floors = $buildings->map(fn (Building $building) => $building->floors)->flatten()->unique();

        $items[] = new FilterList(
            query: Queries::BUILDING,
            name: 'Test 1',
            list: $buildings->transform(fn (Building $building) => new FilterItem(
                name: $building->name,
                value: $building->id
            ))->all()
        );

        return $items;
    }
}
