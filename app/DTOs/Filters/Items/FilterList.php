<?php

namespace App\DTOs\Filters\Items;

use App\Enums\Filters\Queries;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
class FilterList extends BaseFilterItem
{
    /**
     * @param Queries $query
     * @param string $name
     * @param array<FilterItem> $list
     */
    public function __construct(
        Queries $query,
        string $name,
        #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterItem[]')]
        public array $list
    )
    {
        parent::__construct($name);
    }
}
