<?php

namespace App\DTOs\Filters\Items;

use App\Enums\Filters\Queries;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
class FilterListDTO extends BaseFilterItemDTO
{
    /**
     * @param Queries $query
     * @param string $name
     * @param array<FilterItemDTO> $list
     */
    public function __construct(
        Queries $query,
        string $name,
        #[LiteralTypeScriptType('App.DTOs.Filters.Items.FilterItemDTO[]')]
        public array $list
    )
    {
        parent::__construct($name);
    }
}
