<?php

namespace App\Enums\Filters;

enum PriceRanges: string
{
    case UP_TO = 'up_to';
    case OVER = 'over';
    case BETWEEN = 'between';
}
