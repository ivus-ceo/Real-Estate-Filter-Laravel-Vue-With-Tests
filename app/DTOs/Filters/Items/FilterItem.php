<?php

namespace App\DTOs\Filters\Items;

/** @typescript */
class FilterItem extends BaseFilterItem
{
    public function __construct(
        string $name,
        public string $value
    )
    {
        parent::__construct($name);
    }
}
