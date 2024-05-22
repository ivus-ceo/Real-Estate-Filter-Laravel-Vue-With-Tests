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
    public FilterDealTypeDropdownComponentDTO $filterDealTypeDropdownComponentDTO;
    public FilterRoominessDropdownComponentDTO $filterRoominessDropdownComponentDTO;
    public FilterPriceRangeComponentDTO $filterPriceRangeComponentDTO;
    public FilterAreaRangeComponentDTO $filterAreaRangeComponentDTO;
    public FilterSearchComponentDTO $filterSearchComponentDTO;

    public function __construct(
        public DealTypes $dealType,
    )
    {
        $this->filterDealTypeDropdownComponentDTO = new FilterDealTypeDropdownComponentDTO(
            dealType: $this->dealType
        );

        $this->filterRoominessDropdownComponentDTO = new FilterRoominessDropdownComponentDTO(
            dealType: $this->dealType
        );

        $this->filterPriceRangeComponentDTO = new FilterPriceRangeComponentDTO(
            dealType: $this->dealType
        );

        $this->filterAreaRangeComponentDTO = new FilterAreaRangeComponentDTO(
            dealType: $this->dealType
        );

        $this->filterSearchComponentDTO = new FilterSearchComponentDTO(
            dealType: $this->dealType
        );
    }
}
