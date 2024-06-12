<?php

namespace App\Repositories\Slugs;

use App\Models\Slug;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

final class SlugRepository extends BaseRepository implements SlugRepositoryInterface
{
    public function __construct(
        Slug $slug
    )
    {
        parent::__construct($slug);
    }

    public function exists(string $slug): bool
    {
        return $this->model->where(['slug' => $slug])->exists();
    }

    public function createWithRelation(Model $model, array $attributes): Slug
    {
        return $model->slug()->create($attributes);
    }

    public function updateWithRelation(Model $model, array $attributes): bool
    {
        return $model->slug()->update($attributes);
    }
}
