<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * Get all models
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get model by id
     *
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model;
}
