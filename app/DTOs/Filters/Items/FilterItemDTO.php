<?php

namespace App\DTOs\Filters\Items;

/** @typescript */
class FilterItemDTO extends BaseFilterItemDTO
{
    public function __construct(
        string $name,
        public string $value
    )
    {
        parent::__construct($name);
    }
}
