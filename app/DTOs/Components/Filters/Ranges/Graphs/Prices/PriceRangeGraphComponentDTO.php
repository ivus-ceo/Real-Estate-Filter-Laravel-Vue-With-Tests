<?php

namespace App\DTOs\Components\Filters\Ranges\Graphs\Prices;

use App\DTOs\Components\Filters\Ranges\Graphs\BaseRangeGraphComponentDTO;
use App\Enums\Filters\DealTypes;
use App\Models\Room;
use Illuminate\Database\Query\Builder;

class PriceRangeGraphComponentDTO extends BaseRangeGraphComponentDTO
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
        if ($this->dealType->value === DealTypes::SALE->value)
            $column = 'price_sale';
        elseif ($this->dealType->value === DealTypes::RENT->value)
            $column = 'price_rent';
        else
            $column = '';

        return $column;
    }
}
