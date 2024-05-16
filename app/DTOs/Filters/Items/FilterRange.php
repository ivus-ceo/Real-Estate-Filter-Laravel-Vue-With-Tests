<?php

namespace App\DTOs\Filters\Items;

/** @typescript */
class FilterRange extends BaseFilterItem
{
    public function __construct(
        string $name,
        public FilterItem $minItem,
        public FilterItem $maxItem
    )
    {
        parent::__construct($name);
    }
}
