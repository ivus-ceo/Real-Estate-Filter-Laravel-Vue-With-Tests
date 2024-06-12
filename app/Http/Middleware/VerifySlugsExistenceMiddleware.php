<?php

namespace App\Http\Middleware;

use App\Models\{Country, Region, City};
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VerifySlugsExistenceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $segments = $request->segments();

        $country = Country::whereHas('slug', function (Builder $query) use ($segments) {
            $query->where('slug', $segments[0]);
        })->first();

        $city = City::whereHas('slug', function (Builder $query) use ($segments) {
            $query->where('slug', $segments[1]);
        })->first();

        if (empty($country) || empty($city) || $country != $city->region->country) {
            abort(404);
        }

        return $next($request);
    }
}
