<?php

namespace App\Enums\Filters;

enum RentPrices: string
{
    case UP_TO_THOUSAND = ':1000';
    case BETWEEN_THOUSAND_AND_FIVE_HUNDRED = '1000:5000';
    case BETWEEN_FIVE_HUNDRED_AND_TEN_HUNDRED = '5000:10000';
    case BETWEEN_TEN_HUNDRED_AND_FIFTY = '10000:50000';
    case OVER_FIFTY = '50000:';
}
