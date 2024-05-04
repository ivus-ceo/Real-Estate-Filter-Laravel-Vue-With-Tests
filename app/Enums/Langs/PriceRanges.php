<?php

namespace App\Enums\Langs;

enum PriceRanges: string
{
    case UP_TO = 'up_to';
    case OVER = 'over';
    case BETWEEN = 'between';
}
