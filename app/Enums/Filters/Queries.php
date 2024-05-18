<?php

namespace App\Enums\Filters;

enum Queries: string
{
    case DEAL_TYPE = 'dealType';
    case ROOMINESS = 'roominess';
    case MIN_PRICE = 'minPrice';
    case MAX_PRICE = 'maxPrice';
    case MIN_AREA = 'minArea';
    case MAX_AREA = 'maxArea';
    case SEARCH = 'search';
    case BUILDING = 'building';
}
