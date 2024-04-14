<?php

namespace App\DTOs\Components\Filters\Partials\Areas;

use App\Enums\Filters\DealTypes;
use App\Models\Room;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use App\DTOs\Components\Filters\Partials\{FilterRangeComponentDTO, FilterRangeDTO, FilterRangeGraphDTO};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};
use Illuminate\Validation\Rules\Enum;

class FilterAreaRangeComponentDTO extends FilterRangeComponentDTO
{
    public string $dealType;
    /**
     * @var array{
     *     FilterRangeDTO,
     *     FilterRangeDTO,
     *     FilterRangeDTO,
     *     FilterRangeDTO,
     *     FilterRangeDTO
     * }
     */
    public array $items;

    public const array AREAS = [
        '' => '10',
        '10' => '20',
        '20' => '40',
        '40' => '60',
        '60' => '80',
        '80' => '120',
        '120' => '200',
        '200' => '500',
        '500' => '1200',
        '1200' => ''
    ];

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        return [
            'query' => $this->getQuery(),
            'current' => $this->getCurrent(),
            'default' => $this->getDefault(),
            'items' => $this->getItems(),
            'graph' => $this->getGraph()
        ];
    }

    protected function getQuery(): string
    {
        return 'area';
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function getCurrent(): FilterRangeDTO
    {
        $queryMinArea = (int) request()->query('min' . ucfirst($this->getQuery()));
        $queryMaxArea = (int) request()->query('max' . ucfirst($this->getQuery()));
        $queryMinArea = $this->getQueryPriceValue($queryMinArea, 'min');
        $queryMaxArea = $this->getQueryPriceValue($queryMaxArea, 'max');

        return new FilterRangeDTO([
            'name' => $this->getPriceName($queryMinArea, $queryMaxArea),
            'minValue' => $queryMinArea,
            'maxValue' => $queryMaxArea
        ]);
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function getDefault(): FilterRangeDTO
    {
        $minRoomPrice = Room::min('price_' . $this->dealType);
        $maxRoomPrice = Room::max('price_' . $this->dealType);

        return new FilterRangeDTO([
            'name' => $this->getPriceName($minRoomPrice, $maxRoomPrice),
            'minValue' => $minRoomPrice,
            'maxValue' => $maxRoomPrice
        ]);
    }

    /**
     * @return array{
     *      FilterRangeDTO,
     *      FilterRangeDTO,
     *      FilterRangeDTO,
     *      FilterRangeDTO,
     *      FilterRangeDTO
     *  }
     * @throws MissingCastTypeException
     * @throws CastTargetException
     */
    protected function getItems(): array
    {
        $items = [];

        $minRoomPrice = Room::min('price_' . $this->dealType);
        $maxRoomPrice = Room::max('price_' . $this->dealType);

        foreach (self::{strtoupper($this->dealType) . '_PRICES'} as $minPrice => $maxPrice) {
            $minPrice = (int) $minPrice;
            $maxPrice = (int) $maxPrice;

            $items[] = new FilterRangeDTO([
                'name' => $this->getPriceName($minPrice, $maxPrice),
                'minValue' => !empty($minPrice) ? $minPrice : $minRoomPrice,
                'maxValue' => !empty($maxPrice) ? $maxPrice : $maxRoomPrice
            ]);
        }

        return $items;
    }

    private function getPriceName(?int $minPrice, ?int $maxPrice): string
    {
        $locale = app()->getLocale();

        if (empty($minPrice)) {
            return trans('base.filter.prices.up_to', [
                'price' => Number::format($maxPrice, locale: $locale)
            ]);
        } else if (empty($maxPrice)) {
            return trans('base.filter.prices.over', [
                'price' => Number::format($minPrice, locale: $locale)
            ]);
        }

        return trans('base.filter.prices.between', [
            'from' => Number::format($minPrice, locale: $locale),
            'to' => Number::format($maxPrice, locale: $locale)
        ]);
    }

    private function getQueryPriceValue(int $queryPrice, string $defaultPrice): int
    {
        $minRoomPrice = Room::min('price_' . $this->dealType);
        $maxRoomPrice = Room::max('price_' . $this->dealType);

        if (empty($queryPrice)) {
            if ($defaultPrice === 'min') return $minRoomPrice;
            if ($defaultPrice === 'max') return $maxRoomPrice;
        } else if ($queryPrice > $maxRoomPrice) {
            return $maxRoomPrice;
        } else if ($queryPrice < $minRoomPrice) {
            return $minRoomPrice;
        }

        return $queryPrice;
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    private function getGraph(): FilterRangeGraphDTO
    {
        $priceColumn = 'price_' . $this->dealType;
        $minRoomPrice = Room::min($priceColumn);
        $maxRoomPrice = Room::max($priceColumn);
        $numberOfColumns = 40;

        $range = collect(
            range(
                $minRoomPrice,
                $maxRoomPrice,
                round(($maxRoomPrice + $minRoomPrice) / $numberOfColumns)
            )
        );

        $items = $range->keyBy(function (int $minPrice, int $key) use ($range, $maxRoomPrice) {
            $maxPrice = ($range->count() === $key + 1) ? $maxRoomPrice : $range[$key + 1];
            return $minPrice . ':' . $maxPrice;
        })
        ->map(function (int $count, string $prices) use ($priceColumn) {
            $splitted = explode(':', $prices);
            $minPrice = $splitted[0];
            $maxPrice = $splitted[1];
            return Room::whereBetween($priceColumn, [$minPrice, $maxPrice])->count();
        });

        return new FilterRangeGraphDTO([
            'min' => $items->min(),
            'max' => $items->max(),
            'items' => $items
        ]);
    }
}
