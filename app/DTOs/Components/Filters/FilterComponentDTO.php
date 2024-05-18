<?php

namespace App\DTOs\Components\Filters;

use App\DTOs\BaseDTO;
use App\DTOs\Components\Filters\Searches\Search\FilterSearchComponentDTO;
use App\DTOs\Components\Filters\Ranges\{Areas\FilterAreaRangeComponentDTO, Prices\FilterPriceRangeComponentDTO};
use App\DTOs\Components\Filters\Dropdowns\{DealTypes\FilterDealTypeDropdownComponentDTO};
use App\DTOs\Components\Filters\Dropdowns\{Roominess\FilterRoominessDropdownComponentDTO,};
use App\Enums\Filters\DealTypes;
use Illuminate\Validation\{Rules\Enum};

/** @typescript */
class FilterComponentDTO extends BaseDTO
{
    public FilterDealTypeDropdownComponentDTO $dealTypeDropdownComponent;
    public FilterRoominessDropdownComponentDTO $roominessDropdownComponent;
    public FilterPriceRangeComponentDTO $priceRangeComponent;
    public FilterAreaRangeComponentDTO $areaRangeComponent;
    public FilterSearchComponentDTO $searchComponent;

    public function __construct(
        public DealTypes $dealType,
    )
    {
        $this->dealTypeDropdownComponent = new FilterDealTypeDropdownComponentDTO(
            dealType: $this->dealType
        );

        $this->roominessDropdownComponent = new FilterRoominessDropdownComponentDTO(
            dealType: $this->dealType
        );

        $this->priceRangeComponent = new FilterPriceRangeComponentDTO(
            dealType: $this->dealType
        );

        $this->areaRangeComponent = new FilterAreaRangeComponentDTO(
            dealType: $this->dealType
        );

        $this->searchComponent = new FilterSearchComponentDTO(
            dealType: $this->dealType
        );
    }
}
