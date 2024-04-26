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

    private function getFormattedPrice(PriceRanges $priceRange, int $minPrice = null, int $maxPrice = null): string
    {
        $locale = app()->getLocale();
        $currency = Currencies::USD->value;
        $minPriceForHumans = !empty($minPrice) ? Number::forHumans($minPrice) : '';
        $maxPriceForHumans = !empty($maxPrice) ? Number::forHumans($maxPrice) : '';

        if ($priceRange->name === PriceRanges::OVER->name) {
            return trans('base.filter.prices.over', [
                'price' => $maxPriceForHumans
            ]) . ' ' . $currency;
        } elseif ($priceRange->name === PriceRanges::UP_TO->name) {
            return trans('base.filter.prices.up_to', [
                'price' => $minPriceForHumans
            ]) . ' ' . $currency;
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
            ]) . ' ' . $currency;
        }

        return '';
    }

//    /**
//     * @throws CastTargetException
//     * @throws MissingCastTypeException
//     */
//    protected function getCurrent(): FilterRangeDTO
//    {
//        $queryMinPrice = (int) request()->query($this->getMinQuery());
//        $queryMaxPrice = (int) request()->query($this->getMaxQuery());
//        $queryMinPrice = $this->getQueryPriceValue($queryMinPrice, 'min');
//        $queryMaxPrice = $this->getQueryPriceValue($queryMaxPrice, 'max');
//
//        return new FilterRangeDTO([
//            'name' => $this->getPriceName($queryMinPrice, $queryMaxPrice),
//            'minValue' => $queryMinPrice,
//            'maxValue' => $queryMaxPrice
//        ]);
//    }
//
//    /**
//     * @throws CastTargetException
//     * @throws MissingCastTypeException
//     */
//    protected function getDefault(): FilterRangeDTO
//    {
//        $minRoomPrice = Room::min('price_' . $this->dealType);
//        $maxRoomPrice = Room::max('price_' . $this->dealType);
//
//        return new FilterRangeDTO([
//            'name' => $this->getPriceName($minRoomPrice, $maxRoomPrice),
//            'minValue' => $minRoomPrice,
//            'maxValue' => $maxRoomPrice
//        ]);
//    }
//
//    /**
//     * @return array{
//     *      FilterRangeDTO,
//     *      FilterRangeDTO,
//     *      FilterRangeDTO,
//     *      FilterRangeDTO,
//     *      FilterRangeDTO
//     *  }
//     * @throws MissingCastTypeException
//     * @throws CastTargetException
//     */
//    protected function getItems(): array
//    {
//        $items = [];
//
//        $minRoomPrice = Room::min('price_' . $this->dealType);
//        $maxRoomPrice = Room::max('price_' . $this->dealType);
//
//        foreach (self::{strtoupper($this->dealType) . '_PRICES'} as $minPrice => $maxPrice) {
//            $minPrice = (int) $minPrice;
//            $maxPrice = (int) $maxPrice;
//
//            $items[] = new FilterRangeDTO([
//                'name' => $this->getPriceName($minPrice, $maxPrice),
//                'minValue' => !empty($minPrice) ? $minPrice : $minRoomPrice,
//                'maxValue' => !empty($maxPrice) ? $maxPrice : $maxRoomPrice
//            ]);
//        }
//
//        return $items;
//    }
//
//    /**
//     * @throws CastTargetException
//     * @throws MissingCastTypeException
//     */
//    protected function getGraph(): FilterRangeGraphDTO
//    {
//        $priceColumn = 'price_' . $this->dealType;
//        $minRoomPrice = Room::min($priceColumn);
//        $maxRoomPrice = Room::max($priceColumn);
//        $numberOfColumns = 40;
//
//        $range = collect(
//            range(
//                $minRoomPrice,
//                $maxRoomPrice,
//                round(($maxRoomPrice + $minRoomPrice) / $numberOfColumns)
//            )
//        );
//
//        $items = $range->keyBy(function (int $minPrice, int $key) use ($range, $maxRoomPrice) {
//            $maxPrice = ($range->count() === $key + 1) ? $maxRoomPrice : $range[$key + 1];
//            return $minPrice . ':' . $maxPrice;
//        })
//            ->map(function (int $count, string $prices) use ($priceColumn) {
//                $splitted = explode(':', $prices);
//                $minPrice = $splitted[0];
//                $maxPrice = $splitted[1];
//                return Room::whereBetween($priceColumn, [$minPrice, $maxPrice])->count();
//            });
//
//        return new FilterRangeGraphDTO([
//            'min' => $items->min(),
//            'max' => $items->max(),
//            'items' => $items
//        ]);
//    }
//
//    private function getPriceName(?int $minPrice, ?int $maxPrice): string
//    {
//        $locale = app()->getLocale();
//
//        if (empty($minPrice)) {
//            return trans('base.filter.prices.up_to', [
//                'price' => Number::format($maxPrice, locale: $locale)
//            ]);
//        } else if (empty($maxPrice)) {
//            return trans('base.filter.prices.over', [
//                'price' => Number::format($minPrice, locale: $locale)
//            ]);
//        }
//
//        return trans('base.filter.prices.between', [
//            'from' => Number::format($minPrice, locale: $locale),
//            'to' => Number::format($maxPrice, locale: $locale)
//        ]);
//    }
//
//    private function getQueryPriceValue(int $queryPrice, string $defaultPrice): int
//    {
//        $minRoomPrice = Room::min('price_' . $this->dealType);
//        $maxRoomPrice = Room::max('price_' . $this->dealType);
//
//        if (empty($queryPrice)) {
//            if ($defaultPrice === 'min') return $minRoomPrice;
//            if ($defaultPrice === 'max') return $maxRoomPrice;
//        } else if ($queryPrice > $maxRoomPrice) {
//            return $maxRoomPrice;
//        } else if ($queryPrice < $minRoomPrice) {
//            return $minRoomPrice;
//        }
//
//        return $queryPrice;
//    }
}
