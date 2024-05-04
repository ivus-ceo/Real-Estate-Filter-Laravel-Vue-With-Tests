<?php

namespace App\DTOs\Components\Filters;

use App\DTOs\BaseDTO;
use App\DTOs\Components\Filters\Ranges\{Areas\FilterAreaRangeComponentDTO, Prices\FilterPriceRangeComponentDTO};
use App\DTOs\Components\Filters\Dropdowns\{DealTypes\FilterDealTypeDropdownComponentDTO};
use App\DTOs\Components\Filters\Dropdowns\{Roominess\FilterRoominessDropdownComponentDTO,};
use App\Enums\Filters\DealTypes;
use Illuminate\Validation\{Rules\Enum};

class FilterComponentDTO extends BaseDTO
{
//    public ?FilterDealTypeDropdownComponentDTO $dealTypeDropdownComponent;
//    public ?FilterRoominessDropdownComponentDTO $roominessDropdownComponent;
//    public ?FilterPriceRangeComponentDTO $priceRangeComponent;
//    public ?FilterAreaRangeComponentDTO $areaRangeComponent;

    public function __construct(
        public DealTypes $dealType,
//        public ?FilterDealTypeDropdownComponentDTO $dealTypeDropdownComponent,
    )
    {
//        $this->dealTypeDropdownComponent = new FilterDealTypeDropdownComponentDTO([
//            'dealType' => $this->dealType,
//        ]);
    }

//    protected function rules(): array
//    {
//        return [
//            'dealType' => ['required', 'string', new Enum(DealTypes::class)]
//        ];
//    }

//    protected function defaults(): array
//    {
//        return [
//            'dealTypeDropdownComponent' => new FilterDealTypeDropdownComponentDTO([
//                'dealType' => $this->dealType,
//            ]),
//            'roominessDropdownComponent' => new FilterRoominessDropdownComponentDTO([
//                'dealType' => $this->dealType,
//            ]),
//            'priceRangeComponent' => new FilterPriceRangeComponentDTO([
//                'dealType' => $this->dealType,
//            ]),
//            'areaRangeComponent' => new FilterAreaRangeComponentDTO([
//                'dealType' => $this->dealType,
//            ]),
//        ];
//    }

//    protected function casts(): array
//    {
//        return [];
//    }
}
