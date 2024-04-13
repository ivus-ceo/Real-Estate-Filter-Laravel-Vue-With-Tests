<?php

namespace App\DTOs\Components\Filters\Partials\Roominess;

use Illuminate\Validation\Rule;
use App\DTOs\Components\Filters\FilterComponentDTO;
use App\DTOs\Components\Filters\Partials\{
    FilterDropdownComponentDTO,
    FilterInputDTO
};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};

class FilterRoominessDropdownComponentDTO extends FilterDropdownComponentDTO
{
    public string $dealType;
    /** @var array{
     *     any: FilterInputDTO,
     *     0: FilterInputDTO,
     *     1: FilterInputDTO,
     *     2: FilterInputDTO,
     *     3: FilterInputDTO,
     *     4: FilterInputDTO
     * }
     */
    public array $items;

    public const array ROOMINESS = [
        'any',
        '0',
        '1',
        '2',
        '3',
        '4',
    ];

    protected function rules(): array
    {
        return [];
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function defaults(): array
    {
        return [
            'query' => $this->getQuery(),
            'items' => $this->getItems(),
            'default' => $this->getDefault()
        ];
    }

    protected function getQuery(): string
    {
        return 'roominess';
    }

    /**
     * @throws MissingCastTypeException
     * @throws CastTargetException
     * @return array{
     *     any: FilterInputDTO,
     *     0: FilterInputDTO,
     *     1: FilterInputDTO,
     *     2: FilterInputDTO,
     *     3: FilterInputDTO,
     *     4: FilterInputDTO
     * }
     */
    protected function getItems(): array
    {
        $items = [];

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

            $items[] = new FilterInputDTO([
                'name' => trans('base.filter.rooms.' . $roominess),
                'value' => (string) $value,
            ]);
        }

        return $items;
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    protected function getDefault(): FilterInputDTO
    {
        $queryRoominess = request()->query($this->getQuery());

        return new FilterInputDTO([
            'name' => !empty($queryRoominess) ? trans('base.filter.rooms.' . $queryRoominess) : trans('base.filter.rooms.any'),
            'value' => !empty($queryRoominess) && in_array($queryRoominess, self::ROOMINESS) ? $queryRoominess : 'any'
        ]);
    }
}
