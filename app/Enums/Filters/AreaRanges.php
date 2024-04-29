<?php

namespace App\Enums\Filters;

enum AreaRanges: string
{
    case UP_TO = 'up_to';
    case OVER = 'over';
    case BETWEEN = 'between';
}
