<?php

namespace App\DTOs\Components\Filters\Ranges\Prices;

use App\Models\{Room};
use App\DTOs\Components\Filters\Ranges\{BaseFilterRangeComponentDTO,
    Graphs\BaseRangeGraphComponent,
    Graphs\Prices\PriceRangeGraphComponent};
use App\DTOs\Filters\Items\{FilterItem, FilterRange};
use App\Enums\Filters\{DealTypes, Queries, RentPrices, SalePrices};
use App\Enums\Langs\PriceRanges;
use App\Enums\Money\Currencies;
use Illuminate\Support\Number;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
class FilterPriceRangeComponentDTO extends BaseFilterRangeComponentDTO
{
    public function __construct(
        public DealTypes $dealType,
    )
    {
        parent::__construct(
            minQuery: $this->getMinQuery(),
            maxQuery: $this->getMaxQuery(),
            minDefaultItem: $this->getMinDefaultItem(),
            maxDefaultItem: $this->getMaxDefaultItem(),
            graph: $this->getGraph(),
            items: $this->getItems(),
        );

        $this->minQueryItem = $this->getMinQueryItem();
        $this->maxQueryItem = $this->getMaxQueryItem();
    }

    protected function getMinQuery(): Queries
    {
        return Queries::MIN_PRICE;
    }

    protected function getMaxQuery(): Queries
    {
        return Queries::MAX_PRICE;
    }

    protected function getMinQueryItem(): ?FilterItem
    {
        $minQueryItem = parent::getMinQueryItem();

        if (empty($minQueryItem)) return null;

        return new FilterItem(
            name: $this->getFormattedPrice(
                priceRange: PriceRanges::UP_TO,
                minPrice: $minQueryItem->value
            ),
            value: $minQueryItem->value
        );
    }

    protected function getMaxQueryItem(): ?FilterItem
    {
        $maxQueryItem = parent::getMaxQueryItem();

        if (empty($maxQueryItem)) return null;

        return new FilterItem(
            name: $this->getFormattedPrice(
                priceRange: PriceRanges::OVER,
                maxPrice: $maxQueryItem->value
            ),
            value: $maxQueryItem->value
        );
    }

    protected function getMinDefaultItem(): FilterItem
    {
        if ($this->dealType->value === DealTypes::SALE->value)
            $minPrice = Room::min('price_sale');
        elseif ($this->dealType->value === DealTypes::RENT->value)
            $minPrice = Room::min('price_rent');
        else
            $minPrice = 0;

        return new FilterItem(
            name: $this->getFormattedPrice(
                priceRange: PriceRanges::UP_TO,
                minPrice: $minPrice
            ),
            value: $minPrice
        );
    }

    protected function getMaxDefaultItem(): FilterItem
    {
        if ($this->dealType->value === DealTypes::SALE->value)
            $maxPrice = Room::max('price_sale');
        elseif ($this->dealType->value === DealTypes::RENT->value)
            $maxPrice = Room::max('price_rent');
        else
            $maxPrice = 100_000_000;

        return new FilterItem(
            name: $this->getFormattedPrice(
                priceRange: PriceRanges::OVER,
                maxPrice: (int) $maxPrice
            ),
            value: (string) $maxPrice
        );
    }

    protected function getItems(): array
    {
        $items = [];

        if ($this->dealType->value === DealTypes::SALE->value) {
            $minPrice = Room::min('price_sale');
            $maxPrice = Room::max('price_sale');
            $prices = SalePrices::cases();
        } elseif ($this->dealType->value === DealTypes::RENT->value) {
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

            $minItem = new FilterItem(
                name: $this->getFormattedPrice(
                    priceRange: PriceRanges::UP_TO,
                    minPrice: $explodedMinPrice
                ),
                value: $explodedMinPrice
            );

            $maxItem = new FilterItem(
                name: $this->getFormattedPrice(
                    priceRange: PriceRanges::OVER,
                    maxPrice: $explodedMaxPrice
                ),
                value: $explodedMaxPrice
            );

            $items[] = new FilterRange(
                name: $this->getFormattedPrice(
                    priceRange: PriceRanges::BETWEEN,
                    minPrice: (int) $explodedPrice[0] ?? $minPrice,
                    maxPrice: (int) $explodedPrice[1] ?? $maxPrice
                ),
                minItem: $minItem,
                maxItem: $maxItem,
            );
        }

        return $items;
    }

    protected function getGraph(): BaseRangeGraphComponent
    {
        return new PriceRangeGraphComponent(
            dealType: $this->dealType,
        );
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
