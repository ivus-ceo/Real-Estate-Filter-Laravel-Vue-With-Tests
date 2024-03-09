<?php

namespace App\Services\Filters;

use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FilterService
{
    public const DEAL_TYPES = ['sale','rent'];

    private Builder $builder;

    public function __construct(
        private string $dealType
    )
    {
        $this->builder = Room::query();
    }

    public function getDealType(): string
    {
        return $this->dealType;
    }

    public function getRooms(): Collection
    {
        return collect();
    }
}
