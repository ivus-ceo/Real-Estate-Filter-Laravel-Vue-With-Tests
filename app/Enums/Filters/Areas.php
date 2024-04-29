<?php

namespace App\Enums\Filters;

enum Areas: string
{
    case UP_TO_TEN = ':10';
    case BETWEEN_TEN_AND_TWENTY = '10:20';
    case BETWEEN_TWENTY_AND_FORTY = '20:40';
    case BETWEEN_FORTY_AND_SIXTY = '40:60';
    case BETWEEN_SIXTY_AND_EIGHTY = '60:80';
    case BETWEEN_EIGHTY_AND_HUNDRED = '80:120';
    case BETWEEN_HUNDRED_AND_TWO_HUNDRED = '120:200';
    case BETWEEN_TWO_HUNDRED_AND_FIVE_HUNDRED = '200:500';
    case OVER_FIVE_HUNDRED = '500:';
}
