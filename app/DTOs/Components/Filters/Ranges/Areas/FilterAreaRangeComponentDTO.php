<?php

namespace App\DTOs\Components\Filters\Ranges\Areas;

use App\Enums\Money\Currencies;
use App\DTOs\Components\Filters\Partials\{FilterInputDTO, FilterRangeDTO};
use App\DTOs\Components\Filters\Ranges\BaseFilterRangeComponentDTO;
use Illuminate\Support\Number;
use App\Enums\Filters\{Queries, AreaRanges, Areas, DealTypes};
use App\Models\Room;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class FilterAreaRangeComponentDTO extends BaseFilterRangeComponentDTO
{
    /** @var array<FilterRangeDTO> */
    public array $items;

    protected function getMinQueryName(): string
    {
        return Queries::MIN_AREA->value;
    }

    protected function getMaxQueryName(): string
    {
        return Queries::MAX_AREA->value;
    }

    protected function getMinQueryItem(): ?FilterInputDTO
    {
        $minQueryItem = parent::getMinQueryItem();

        if (empty($minQueryItem)) return null;

        return new FilterInputDTO([
            'name' => $this->getFormattedArea(
                areaRange: AreaRanges::UP_TO,
                minArea: $minQueryItem->value
            ),
            'value' => $minQueryItem->value
        ]);
    }

    protected function getMaxQueryItem(): ?FilterInputDTO
    {
        $maxQueryItem = parent::getMaxQueryItem();

        if (empty($maxQueryItem)) return null;

        return new FilterInputDTO([
            'name' => $this->getFormattedArea(
                areaRange: AreaRanges::OVER,
                maxArea: $maxQueryItem->value
            ),
            'value' => $maxQueryItem->value
        ]);
    }

    protected function getMinDefaultItem(): FilterInputDTO
    {
        $minArea = Room::min('area');

        return new FilterInputDTO([
            'name' => $this->getFormattedArea(
                areaRange: AreaRanges::UP_TO,
                minArea: $minArea
            ),
            'value' => (string) $minArea
        ]);
    }

    protected function getMaxDefaultItem(): FilterInputDTO
    {
        $maxArea = Room::max('area');

        return new FilterInputDTO([
            'name' => $this->getFormattedArea(
                areaRange: AreaRanges::OVER,
                maxArea: $maxArea
            ),
            'value' => (string) $maxArea
        ]);
    }

    protected function getItems(): array
    {
        $items = [];
        $minArea = Room::min('area');
        $maxArea = Room::max('area');

        foreach (Areas::cases() as $area) {
            $explodedArea = explode(':', $area->value);
            $explodedMinArea = !empty($explodedArea[0]) ? (string) $explodedArea[0] : (string) $minArea;
            $explodedMaxArea = !empty($explodedArea[1]) ? (string) $explodedArea[1] : (string) $maxArea;

            $minValue = new FilterInputDTO([
                'name' => $this->getFormattedArea(
                    areaRange: AreaRanges::UP_TO,
                    minArea: $explodedMinArea
                ),
                'value' => $explodedMinArea
            ]);

            $maxValue = new FilterInputDTO([
                'name' => $this->getFormattedArea(
                    areaRange: AreaRanges::OVER,
                    maxArea: $explodedMaxArea
                ),
                'value' => $explodedMaxArea
            ]);

            $items[] = new FilterRangeDTO([
                'name' => $this->getFormattedArea(
                    areaRange: AreaRanges::BETWEEN,
                    minArea: (int) $explodedArea[0] ?? $minArea,
                    maxArea: (int) $explodedArea[1] ?? $maxArea
                ),
                'minValue' => $minValue,
                'maxValue' => $maxValue,
            ]);
        }

        return $items;
    }

    protected function getGraph(): array
    {
        return collect($this->getGraphRanges())
            ->transform(function (int $count, string $range) {
                $numbers = explode(':', $range);
                return Room::whereBetween('area', [$numbers[0], $numbers[1]])->count();
            })
            ->toArray();
    }

    private function getFormattedArea(AreaRanges $areaRange, int $minArea = null, int $maxArea = null): string
    {
        $locale = app()->getLocale();
        $minAreaForHumans = !empty($minArea) ? Number::format($minArea, locale: $locale) : '';
        $maxAreaForHumans = !empty($maxArea) ? Number::format($maxArea, locale: $locale) : '';

        if ($areaRange->name === AreaRanges::OVER->name) {
            return trans('base.filter.areas.over', [
                'area' => $maxAreaForHumans
            ]);
        } elseif ($areaRange->name === AreaRanges::UP_TO->name) {
            return trans('base.filter.areas.up_to', [
                'area' => $minAreaForHumans
            ]);
        } elseif ($areaRange->name === AreaRanges::BETWEEN->name) {

            if (empty($minArea)) {
                return self::getFormattedArea(
                    areaRange: AreaRanges::UP_TO,
                    minArea: $maxArea
                );
            } elseif (empty($maxArea)) {
                return self::getFormattedArea(
                    areaRange: AreaRanges::OVER,
                    maxArea: $minArea
                );
            }

            return trans('base.filter.areas.between', [
                'from' => $minAreaForHumans,
                'to' => $maxAreaForHumans
            ]);
        }

        return '';
    }
}
