<?php

namespace App\DTOs\Pages\Public;

use App\DTOs\BaseDTO;
use App\Enums\Filters\DealTypes;
use App\DTOs\Components\Filters\{FilterComponentDTO};

class SalePropertyPageDTO extends BaseDTO
{
    public FilterComponentDTO $filterComponentDTO;

    public function __construct()
    {
        $this->filterComponentDTO = new FilterComponentDTO(
            dealType: DealTypes::SALE
        );
    }
}
