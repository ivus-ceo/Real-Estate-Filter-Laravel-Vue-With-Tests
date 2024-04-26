<?php

namespace App\Enums\Filters;

enum Roominess: int
{
    case STUDIO = 0;
    case ONE_BEDROOM = 1;
    case TWO_BEDROOM = 2;
    case THREE_BEDROOM = 3;
    case FOUR_BEDROOM = 4;
}
