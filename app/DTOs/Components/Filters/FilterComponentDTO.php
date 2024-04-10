<?php

namespace App\DTOs\Components\Filters;

use App\Models\Room;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FilterComponentDTO extends ValidatedDTO
{
    public string $dealType;
    public FilterInputDTO $defaultDealType;
    public FilterInputDTO $defaultRoominess;
    public FilterInputDTO $defaultPrice;
    public Collection $dealTypes;
    public Collection $roominess;
    public Collection $prices;

    public const string SALE = 'sale';
    public const string RENT = 'rent';
    public const array DEAL_TYPES = [
        self::SALE,
        self::RENT,
    ];
    public const array ROOMINESS = [
        'any',
        '0',
        '1',
        '2',
        '3',
        '4',
    ];
    public const array SALE_PRICES = [
        ':100000',
        '100000:500000',
        '500000:1000000',
        '1000000:5000000',
        '5000000:'
    ];
    public const array RENT_PRICES = [
        ':1000',
        '1000:5000',
        '5000:10000',
        '10000:50000',
        '50000:'
    ];

    protected function rules(): array
    {
        return [
            'dealType' => ['required', 'string', Rule::in(self::DEAL_TYPES)]
        ];
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        return [
            'defaultDealType' => $this->getDefaultDealType(),
            'defaultRoominess' => $this->getDefaultRoominess(),
            'defaultPrice' => $this->getDefaultPrice(),
            'dealTypes' => $this->getDealTypes(),
            'roominess' => $this->getRoominess(),
            'prices' => $this->getPrices(),
        ];
    }

    protected function casts(): array
    {
        return [];
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    private function getDefaultDealType(): FilterInputDTO
    {
        return new FilterInputDTO([
            'name' => trans('base.filter.deal_types.' . $this->dealType),
            'value' => $this->dealType
        ]);
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    private function getDefaultRoominess(): FilterInputDTO
    {
        $queryRoominess = request()->query('roominess');

        return new FilterInputDTO([
            'name' => !empty($queryRoominess) ? trans('base.filter.rooms.' . $queryRoominess) : trans('base.filter.rooms.any'),
            'value' => !empty($queryRoominess) ? $queryRoominess : 'any'
        ]);
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    private function getDefaultPrice(): FilterInputDTO
    {
        $queryPrice = request()->query('price');
        $min = Room::min('price_' . $this->dealType);
        $max = Room::max('price_' . $this->dealType);

        return new FilterInputDTO([
            'name' => trans('base.filter.prices.between', [
                'from' => Number::format($min, locale: app()->getLocale()),
                'to' => Number::format($max, locale: app()->getLocale()),
            ]),
            'value' => !empty($queryPrice) ? $queryPrice : "$min:$max"
        ]);
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    private function getDealTypes(): Collection
    {
        $collection = collect();

        foreach (self::DEAL_TYPES as $dealType) {
            $collection->put($dealType, new FilterInputDTO([
                'name' => trans('base.filter.deal_types.' . $dealType),
                'value' => $dealType,
            ]));
        }

        return $collection;
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    private function getRoominess(): Collection
    {
        $collection = collect();

        foreach (self::ROOMINESS as $roominess) {
            $isFirst = $roominess === '0';
            $isLast = $roominess === '4';

            if ($isFirst) {
                $value = $roominess;
            } else if ($isLast) {
                $value = $roominess . ':';
            } else {
                $value = $roominess;
            }

            $collection->push(new FilterInputDTO([
                'name' => trans('base.filter.rooms.' . $roominess),
                'value' => (string) $value,
            ]));
        }

        return $collection;
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    private function getPrices(): Collection
    {
        $collection = collect();
        $queryPrice = request()->query('price');

        $minPrice = Room::min('price_' . $this->dealType);
        $maxPrice = Room::max('price_' . $this->dealType);

        $collection->push(new FilterInputDTO([
            'name' => trans('base.filter.prices.between', ['from' => $minPrice, 'to' => $maxPrice]),
            'value' => "$minPrice:$maxPrice",
            'default' => empty($queryPrice)
        ]));

        foreach (self::{strtoupper($this->dealType) . '_PRICES'} as $price) {
            $splitted = explode(':', $price);

            if (empty($splitted[0])) {
                $name = trans('base.filter.prices.up_to', [
                    'price' => Number::format($splitted[1], locale: app()->getLocale())
                ]);
            } else if (empty($splitted[1])) {
                $name = trans('base.filter.prices.over', [
                    'price' => Number::format($splitted[0], locale: app()->getLocale())
                ]);
            } else {
                $name = trans('base.filter.prices.between', [
                    'from' => Number::format($splitted[0], locale: app()->getLocale()),
                    'to' => Number::format($splitted[1], locale: app()->getLocale())
                ]);
            }

            $collection->push(new FilterInputDTO([
                'name' => $name,
                'value' => $price,
                'default' => $queryPrice === $price
            ]));
        }

        return $collection;
    }
}
