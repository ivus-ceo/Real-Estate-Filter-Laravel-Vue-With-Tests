<?php

namespace App\DTOs\Components\Filters\Searches;

use App\DTOs\Filters\Items\FilterItem;
use App\Enums\Filters\Queries;

abstract class BaseFilterSearchComponentDTO
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
