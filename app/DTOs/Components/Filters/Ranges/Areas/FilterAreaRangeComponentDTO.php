<?php

namespace App\DTOs\Components\Filters\Ranges\Areas;

use App\DTOs\Components\Filters\Ranges\BaseFilterRangeComponentDTO;
use App\DTOs\Components\Filters\Ranges\Graphs\Areas\AreaRangeGraphComponentDTO;
use App\DTOs\Components\Filters\Ranges\Graphs\BaseRangeGraphComponentDTO;
use App\DTOs\Filters\Items\FilterItemDTO;
use App\DTOs\Filters\Items\FilterRangeDTO;
use App\Enums\Langs\AreaRanges;
use App\Models\Room;
use App\Enums\Filters\{Areas, DealTypes, Queries};
use Illuminate\Support\Number;

/** @typescript */
class FilterAreaRangeComponentDTO extends BaseFilterRangeComponentDTO
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
        return Queries::MIN_AREA;
    }

    protected function getMaxQuery(): Queries
    {
        return Queries::MAX_AREA;
    }

    protected function getMinQueryItem(): ?FilterItemDTO
    {
        $minQueryItem = parent::getMinQueryItem();

        if (empty($minQueryItem)) return null;

        return new FilterItemDTO(
            name: $this->getFormattedArea(
                areaRange: AreaRanges::UP_TO,
                minArea: $minQueryItem->value
            ),
            value: $minQueryItem->value
        );
    }

    protected function getMaxQueryItem(): ?FilterItemDTO
    {
        $maxQueryItem = parent::getMaxQueryItem();

        if (empty($maxQueryItem)) return null;

        return new FilterItemDTO(
            name: $this->getFormattedArea(
                areaRange: AreaRanges::OVER,
                maxArea: $maxQueryItem->value
            ),
            value: $maxQueryItem->value
        );
    }

    protected function getMinDefaultItem(): FilterItemDTO
    {
        $minArea = Room::min('area');

        return new FilterItemDTO(
            name: $this->getFormattedArea(
                areaRange: AreaRanges::UP_TO,
                minArea: $minArea
            ),
            value: (string) $minArea
        );
    }

    protected function getMaxDefaultItem(): FilterItemDTO
    {
        $maxArea = Room::max('area');

        return new FilterItemDTO(
            name: $this->getFormattedArea(
                areaRange: AreaRanges::OVER,
                maxArea: $maxArea
            ),
            value: (string) $maxArea
        );
    }

    protected function getItems(): array
    {
        $items = [];
        $minArea = Room::min('area');
        $maxArea = Room::max('area');

        foreach (Areas::cases() as $area) {
            $explodedArea = explode(':', $area->value);
            $explodedMinArea = !empty($explodedArea[0]) ? $explodedArea[0] : $minArea;
            $explodedMaxArea = !empty($explodedArea[1]) ? $explodedArea[1] : $maxArea;

            $minItem = new FilterItemDTO(
                name: $this->getFormattedArea(
                    areaRange: AreaRanges::UP_TO,
                    minArea: $explodedMinArea
                ),
                value: $explodedMinArea
            );

            $maxItem = new FilterItemDTO(
                name: $this->getFormattedArea(
                    areaRange: AreaRanges::OVER,
                    maxArea: $explodedMaxArea
                ),
                value: $explodedMaxArea
            );

            $items[] = new FilterRangeDTO(
                name: $this->getFormattedArea(
                    areaRange: AreaRanges::BETWEEN,
                    minArea: (int) $explodedArea[0] ?? $minArea,
                    maxArea: (int) $explodedArea[1] ?? $maxArea
                ),
                minItem: $minItem,
                maxItem: $maxItem,
            );
        }

        return $items;
    }

    protected function getGraph(): BaseRangeGraphComponentDTO
    {
        return new AreaRangeGraphComponentDTO(
            dealType: $this->dealType
        );
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
