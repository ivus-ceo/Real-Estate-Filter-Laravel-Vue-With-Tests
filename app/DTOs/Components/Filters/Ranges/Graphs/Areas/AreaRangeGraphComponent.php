<?php

namespace App\DTOs\Components\Filters\Ranges\Graphs\Areas;

use App\DTOs\Components\Filters\Ranges\Graphs\BaseRangeGraphComponent;
use App\Enums\Filters\DealTypes;
use App\Models\Room;
use Illuminate\Database\Query\Builder;

/** @typescript */
class AreaRangeGraphComponent extends BaseRangeGraphComponent
{
    public function __construct(
        public DealTypes $dealType,
    )
    {
        $model = $this->getModel();
        /** @var Builder $model */
        $model = new $model;

        parent::__construct(
            minNumber: $model::min($this->getColumn()),
            maxNumber: $model::max($this->getColumn())
        );
    }

    protected function getModel(): string
    {
        return Room::class;
    }

    protected function getColumn(): string
    {
        return 'area';
    }
}
