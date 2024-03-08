<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistrictRequest;
use App\Http\Resources\DistrictResource;
use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', District::class);

        return DistrictResource::collection(District::all());
    }

    public function store(DistrictRequest $request)
    {
        $this->authorize('create', District::class);

        return new DistrictResource(District::create($request->validated()));
    }

    public function show(District $district)
    {
        $this->authorize('view', $district);

        return new DistrictResource($district);
    }

    public function update(DistrictRequest $request, District $district)
    {
        $this->authorize('update', $district);

        $district->update($request->validated());

        return new DistrictResource($district);
    }

    public function destroy(District $district)
    {
        $this->authorize('delete', $district);

        $district->delete();

        return response()->json();
    }
}
