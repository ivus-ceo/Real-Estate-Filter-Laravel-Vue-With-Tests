<?php

namespace App\DTOs\Filters\Items;

use App\DTOs\BaseDTO;
use App\Enums\Filters\Queries;

/** @typescript */
class BaseFilterItem extends BaseDTO
{
    public function __construct(
        public string $name,
    )
    {}
}
