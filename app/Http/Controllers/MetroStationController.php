<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetroStationRequest;
use App\Http\Resources\MetroStationResource;
use App\MetroStation;

class MetroStationController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', MetroStation::class);

        return MetroStationResource::collection(MetroStation::all());
    }

    public function store(MetroStationRequest $request)
    {
        $this->authorize('create', MetroStation::class);

        return new MetroStationResource(MetroStation::create($request->validated()));
    }

    public function show(MetroStation $metroStation)
    {
        $this->authorize('view', $metroStation);

        return new MetroStationResource($metroStation);
    }

    public function update(MetroStationRequest $request, MetroStation $metroStation)
    {
        $this->authorize('update', $metroStation);

        $metroStation->update($request->validated());

        return new MetroStationResource($metroStation);
    }

    public function destroy(MetroStation $metroStation)
    {
        $this->authorize('delete', $metroStation);

        $metroStation->delete();

        return response()->json();
    }
}
