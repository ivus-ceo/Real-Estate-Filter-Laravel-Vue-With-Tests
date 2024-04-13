<?php

namespace App\DTOs\Components\Filters;

use App\DTOs\BaseValidatedDTO;
use App\Enums\Filters\DealTypes;
use App\DTOs\Components\Filters\Partials\{
    DealTypes\FilterDealTypeDropdownComponentDTO,
    Prices\FilterPriceRangeComponentDTO,
    Roominess\FilterRoominessDropdownComponentDTO,
};
use App\Models\{Room};
use Illuminate\Support\{Collection, Number};
use Illuminate\Validation\{Rule, Rules\Enum};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};

class FilterComponentDTO extends BaseValidatedDTO
{
    public string $dealType;
    public ?FilterDealTypeDropdownComponentDTO $dealTypeDropdownComponent;
    public ?FilterRoominessDropdownComponentDTO $roominessDropdownComponent;
    public ?FilterPriceRangeComponentDTO $priceDropdownComponent;

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
            'dealTypeDropdownComponent' => new FilterDealTypeDropdownComponentDTO(['dealType' => $this->dealType]),
            'roominessDropdownComponent' => app(FilterRoominessDropdownComponentDTO::class),
            'priceRangeComponent' => new FilterPriceRangeComponentDTO(['dealType' => $this->dealType]),
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
