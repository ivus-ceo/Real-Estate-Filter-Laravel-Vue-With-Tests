<?php

namespace App\Services\Slugs;

use App\Exceptions\SlugRelationshipDoesNotExistException;
use App\Models\Slug;
use App\Repositories\Slugs\SlugRepositoryInterface;
use App\Traits\Models\HasSlugTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;

class SlugService
{
    public function __construct(
        private readonly SlugRepositoryInterface $slugRepository
    )
    {}

    public function getUniqueName(string $name): string
    {
        $slug = Str::slug($name);
        return ($this->exists($slug)) ? $slug .= '-' . uniqid() : $slug;
    }

    public function exists(string $slug): bool
    {
        return $this->slugRepository->exists($slug);
    }

    /**
     * @throws SlugRelationshipDoesNotExistException
     * @throws ReflectionException
     */
    public function createWithRelation(Model $model, array $attributes): Slug
    {
        $this->hasSlugTrait($model);
        return $this->slugRepository->createWithRelation($model, $attributes);
    }

    /**
     * @throws SlugRelationshipDoesNotExistException
     * @throws ReflectionException
     */
    public function updateWithRelation(Model $model, array $attributes): bool
    {
        $this->hasSlugTrait($model);
        return $this->slugRepository->updateWithRelation($model, $attributes);
    }

    /**
     * @param Model $model
     * @return bool
     * @throws SlugRelationshipDoesNotExistException
     * @throws ReflectionException
     */
    private function hasSlugTrait(Model $model): bool
    {
        $modelClass = get_class($model);
        $hasSlugTrait = in_array(
            HasSlugTrait::class,
            array_keys((new ReflectionClass($modelClass))->getTraits())
        );

        if (!$hasSlugTrait) {
            throw new SlugRelationshipDoesNotExistException(
                'Slug relationship does not exist on ' . $modelClass . ' use ' . HasSlugTrait::class . ' trait'
            );
        }

        return true;
    }
}
