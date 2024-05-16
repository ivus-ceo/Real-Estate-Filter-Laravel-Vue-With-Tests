<?php

namespace App\DTOs\Components\Filters\Ranges\Graphs;

use App\DTOs\BaseDTO;
use Illuminate\Database\Query\Builder;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

/** @typescript */
abstract class BaseRangeGraphComponent extends BaseDTO
{
    #[LiteralTypeScriptType('Record<string, number>')]
    /** @var $ranges array<string, int> */
    public array $ranges = [];

    public function __construct(
        public int $minNumber,
        public int $maxNumber,
        public int $numberOfColumns = 40
    )
    {
        $this->ranges = collect($this->getNumberRangesByNumberOfColumns())
            ->transform(function (int $count, string $range) {
                $numbers = explode(':', $range);
                $model = $this->getModel();
                /** @var Builder $model */
                $model = new $model;
                return $model::whereBetween($this->getColumn(), [$numbers[0], $numbers[1]])->count();
            })
            ->toArray();
    }

    /**
     * Get number ranges by number of columns to count after
     *
     * Example output:
     * "50047:301292" => 0
     * "301292:552537" => 0
     * "552537:803782" => 0
     *
     * @return array<string, int>
     */
    protected function getNumberRangesByNumberOfColumns(): array
    {
        $range = collect(
            range(
                $this->minNumber,
                $this->maxNumber,
                round(($this->minNumber + $this->maxNumber) / $this->numberOfColumns)
            )
        );

        return $range
            ->keyBy(function (int $minNumber, int $key) use ($range) {
                $maxPrice = ($range->count() === $key + 1) ? $this->maxNumber : $range[$key + 1];
                return $minNumber . ':' . $maxPrice;
            })
            ->transform(fn () => 0)
            ->toArray();
    }

    abstract protected function getModel(): string;

    abstract protected function getColumn(): string;
}
