<?php

namespace App\Http\Controllers;

use App\BuildingFloor;
use App\Http\Requests\BuildingFloorRequest;
use App\Http\Resources\BuildingFloorResource;

class BuildingFloorController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', BuildingFloor::class);

        return BuildingFloorResource::collection(BuildingFloor::all());
    }

    public function store(BuildingFloorRequest $request)
    {
        $this->authorize('create', BuildingFloor::class);

        return new BuildingFloorResource(BuildingFloor::create($request->validated()));
    }

    public function show(BuildingFloor $buildingFloor)
    {
        $this->authorize('view', $buildingFloor);

        return new BuildingFloorResource($buildingFloor);
    }

    public function update(BuildingFloorRequest $request, BuildingFloor $buildingFloor)
    {
        $this->authorize('update', $buildingFloor);

        $buildingFloor->update($request->validated());

        return new BuildingFloorResource($buildingFloor);
    }

    public function destroy(BuildingFloor $buildingFloor)
    {
        $this->authorize('delete', $buildingFloor);

        $buildingFloor->delete();

        return response()->json();
    }
}
