<?php

namespace App\DTOs\Components\Filters\Ranges\Prices;

use App\Enums\Money\Currencies;
use App\DTOs\Components\Filters\Partials\{FilterInputDTO, FilterRangeDTO};
use App\DTOs\Components\Filters\Ranges\BaseFilterRangeComponentDTO;
use Illuminate\Support\Number;
use App\Enums\Filters\{Queries, PriceRanges, DealTypes, RentPrices, SalePrices};
use App\Models\Room;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class FilterPriceRangeComponentDTO extends BaseFilterRangeComponentDTO
{
    /** @var array<FilterRangeDTO> */
    public array $items;

    protected function getMinQueryName(): string
    {
        return Queries::MIN_PRICE->value;
    }

    protected function getMaxQueryName(): string
    {
        return Queries::MAX_PRICE->value;
    }

    protected function getMinQueryItem(): ?FilterInputDTO
    {
        $minQueryItem = parent::getMinQueryItem();

        if (empty($minQueryItem)) return null;

        return new FilterInputDTO([
            'name' => $this->getFormattedPrice(
                priceRange: PriceRanges::UP_TO,
                minPrice: $minQueryItem->value
            ),
            'value' => $minQueryItem->value
        ]);
    }

    protected function getMaxQueryItem(): ?FilterInputDTO
    {
        $maxQueryItem = parent::getMaxQueryItem();

        if (empty($maxQueryItem)) return null;

        return new FilterInputDTO([
            'name' => $this->getFormattedPrice(
                priceRange: PriceRanges::OVER,
                maxPrice: $maxQueryItem->value
            ),
            'value' => $maxQueryItem->value
        ]);
    }

    protected function getMinDefaultItem(): FilterInputDTO
    {
        if ($this->dealType === DealTypes::SALE->value)
            $minPrice = Room::min('price_sale');
        elseif ($this->dealType === DealTypes::RENT->value)
            $minPrice = Room::min('price_rent');

        return new FilterInputDTO([
            'name' => $this->getFormattedPrice(
                priceRange: PriceRanges::UP_TO,
                minPrice: (int) $minPrice
            ),
            'value' => (string) $minPrice
        ]);
    }

    protected function getMaxDefaultItem(): FilterInputDTO
    {
        if ($this->dealType === DealTypes::SALE->value)
            $maxPrice = Room::max('price_sale');
        elseif ($this->dealType === DealTypes::RENT->value)
            $maxPrice = Room::max('price_rent');

        return new FilterInputDTO([
            'name' => $this->getFormattedPrice(
                priceRange: PriceRanges::OVER,
                maxPrice: (int) $maxPrice
            ),
            'value' => (string) $maxPrice
        ]);
    }

    protected function getItems(): array
    {
        $items = [];

        if ($this->dealType === DealTypes::SALE->value) {
            $minPrice = Room::min('price_sale');
            $maxPrice = Room::max('price_sale');
            $prices = SalePrices::cases();
        } elseif ($this->dealType === DealTypes::RENT->value) {
            $minPrice = Room::min('price_rent');
            $maxPrice = Room::max('price_rent');
            $prices = RentPrices::cases();
        } else {
            return $items;
        }

        foreach ($prices as $price) {
            $explodedPrice = explode(':', $price->value);
            $explodedMinPrice = !empty($explodedPrice[0]) ? (string) $explodedPrice[0] : (string) $minPrice;
            $explodedMaxPrice = !empty($explodedPrice[1]) ? (string) $explodedPrice[1] : (string) $maxPrice;

            $minValue = new FilterInputDTO([
                'name' => $this->getFormattedPrice(
                    priceRange: PriceRanges::UP_TO,
                    minPrice: $explodedMinPrice
                ),
                'value' => $explodedMinPrice
            ]);

            $maxValue = new FilterInputDTO([
                'name' => $this->getFormattedPrice(
                    priceRange: PriceRanges::OVER,
                    maxPrice: $explodedMaxPrice
                ),
                'value' => $explodedMaxPrice
            ]);

            $items[] = new FilterRangeDTO([
                'name' => $this->getFormattedPrice(
                    priceRange: PriceRanges::BETWEEN,
                    minPrice: (int) $explodedPrice[0] ?? $minPrice,
                    maxPrice: (int) $explodedPrice[1] ?? $maxPrice
                ),
                'minValue' => $minValue,
                'maxValue' => $maxValue,
            ]);
        }

        return $items;
    }

    protected function getGraph(): array
    {
        if ($this->dealType === DealTypes::SALE->value)
            $column = 'price_sale';
        elseif ($this->dealType === DealTypes::RENT->value)
            $column = 'price_rent';

        return collect($this->getGraphRanges())
            ->transform(function (int $count, string $range) use ($column) {
                $numbers = explode(':', $range);
                return Room::whereBetween($column, [$numbers[0], $numbers[1]])->count();
            })
            ->toArray();
    }

    private function getFormattedPrice(PriceRanges $priceRange, int $minPrice = null, int $maxPrice = null): string
    {
        $locale = app()->getLocale();
        $currency = Currencies::USD;
        $minPriceForHumans = !empty($minPrice) ? Number::currency($minPrice, locale: $locale, in: $currency->name) : '';
        $maxPriceForHumans = !empty($maxPrice) ? Number::currency($maxPrice, locale: $locale, in: $currency->name) : '';

        if ($priceRange->name === PriceRanges::OVER->name) {
            return trans('base.filter.prices.over', [
                'price' => $maxPriceForHumans
            ]);
        } elseif ($priceRange->name === PriceRanges::UP_TO->name) {
            return trans('base.filter.prices.up_to', [
                'price' => $minPriceForHumans
            ]);
        } elseif ($priceRange->name === PriceRanges::BETWEEN->name) {

            if (empty($minPrice)) {
                return self::getFormattedPrice(
                    priceRange: PriceRanges::UP_TO,
                    minPrice: $maxPrice
                );
            } elseif (empty($maxPrice)) {
                return self::getFormattedPrice(
                    priceRange: PriceRanges::OVER,
                    maxPrice: $minPrice
                );
            }

            return trans('base.filter.prices.between', [
                'from' => $minPriceForHumans,
                'to' => $maxPriceForHumans
            ]);
        }

        return '';
    }
}
