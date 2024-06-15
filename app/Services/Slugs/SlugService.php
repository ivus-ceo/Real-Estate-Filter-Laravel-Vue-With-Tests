<?php

namespace App\Services\Slugs;

use App\Models\Slug;
use Illuminate\Support\Str;

class SlugService
{
    public function getUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        return Slug::where('slug', $slug)->exists() ? $slug . uniqid() : $slug;
    }
}
