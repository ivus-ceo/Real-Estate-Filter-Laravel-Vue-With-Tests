<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Http\Requests\FloorRequest;
use App\Http\Resources\FloorResource;

class FloorController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Floor::class);

        return FloorResource::collection(Floor::all());
    }

    public function store(FloorRequest $request)
    {
        $this->authorize('create', Floor::class);

        return new FloorResource(Floor::create($request->validated()));
    }

    public function show(Floor $floor)
    {
        $this->authorize('view', $floor);

        return new FloorResource($floor);
    }

    public function update(FloorRequest $request, Floor $floor)
    {
        $this->authorize('update', $floor);

        $floor->update($request->validated());

        return new FloorResource($floor);
    }

    public function destroy(Floor $floor)
    {
        $this->authorize('delete', $floor);

        $floor->delete();

        return response()->json();
    }
}
