<?php

namespace App\DTOs\Components\Filters\Lists;

use App\DTOs\Filters\Items\FilterItem;
use App\Enums\Filters\Queries;

abstract class BaseFilterListComponentDTO
{
    public ?FilterItem $queryItem;

    public function __construct(
        public Queries $query,
        public FilterItem $defaultItem,
        public array $items,
    )
    {
    }
}
