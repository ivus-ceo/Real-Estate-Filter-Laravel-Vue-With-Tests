<?php

namespace App\Http\Controllers;

use App\Building;
use App\Http\Requests\BuildingRequest;
use App\Http\Resources\BuildingResource;

class BuildingController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Building::class);

        return BuildingResource::collection(Building::all());
    }

    public function store(BuildingRequest $request)
    {
        $this->authorize('create', Building::class);

        return new BuildingResource(Building::create($request->validated()));
    }

    public function show(Building $building)
    {
        $this->authorize('view', $building);

        return new BuildingResource($building);
    }

    public function update(BuildingRequest $request, Building $building)
    {
        $this->authorize('update', $building);

        $building->update($request->validated());

        return new BuildingResource($building);
    }

    public function destroy(Building $building)
    {
        $this->authorize('delete', $building);

        $building->delete();

        return response()->json();
    }
}
