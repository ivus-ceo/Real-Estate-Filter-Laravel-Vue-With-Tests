<?php

namespace App\DTOs\Filters\Items;

/** @typescript */
class FilterRangeDTO extends BaseFilterItemDTO
{
    public function __construct(
        string               $name,
        public FilterItemDTO $minItem,
        public FilterItemDTO $maxItem
    )
    {
        parent::__construct($name);
    }
}
