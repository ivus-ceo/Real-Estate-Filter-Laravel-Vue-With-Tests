<?php

namespace App\Services\Filters;

use App\DTOs\Filters\FilterDTO;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class FilterService
{
    private Builder $builder;

    public function __construct(FilterDTO $filterDTO)
    {
        $this->builder = Room::query();
    }

    public function getPaginatedData(): LengthAwarePaginator
    {
        return $this->builder->paginate(10);
    }
}
