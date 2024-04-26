<?php

namespace App\DTOs\Components\Filters;

use App\DTOs\BaseValidatedDTO;
use App\DTOs\Components\Filters\Ranges\{Prices\FilterPriceRangeComponentDTO};
use App\DTOs\Components\Filters\Dropdowns\{DealTypes\FilterDealTypeDropdownComponentDTO};
use App\DTOs\Components\Filters\Dropdowns\{Roominess\FilterRoominessDropdownComponentDTO,};
use App\Enums\Filters\DealTypes;
use Illuminate\Validation\{Rules\Enum};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};

class FilterComponentDTO extends BaseValidatedDTO
{
    public string $dealType;
    public ?FilterDealTypeDropdownComponentDTO $dealTypeDropdownComponent;
    public ?FilterRoominessDropdownComponentDTO $roominessDropdownComponent;
    public ?FilterPriceRangeComponentDTO $priceRangeComponent;

    protected function rules(): array
    {
        return [
            'dealType' => ['required', 'string', new Enum(DealTypes::class)]
        ];
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        return [
            'dealTypeDropdownComponent' => new FilterDealTypeDropdownComponentDTO([
                'dealType' => $this->dealType,
            ]),
            'roominessDropdownComponent' => new FilterRoominessDropdownComponentDTO([
                'dealType' => $this->dealType,
            ]),
            'priceRangeComponent' => new FilterPriceRangeComponentDTO([
                'dealType' => $this->dealType,
            ]),
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
