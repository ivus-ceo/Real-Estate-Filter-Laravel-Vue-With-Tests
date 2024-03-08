<?php

namespace App\Http\Controllers;

use App\Http\Requests\StreetRequest;
use App\Http\Resources\StreetResource;
use App\Models\Street;

class StreetController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Street::class);

        return StreetResource::collection(Street::all());
    }

    public function store(StreetRequest $request)
    {
        $this->authorize('create', Street::class);

        return new StreetResource(Street::create($request->validated()));
    }

    public function show(Street $street)
    {
        $this->authorize('view', $street);

        return new StreetResource($street);
    }

    public function update(StreetRequest $request, Street $street)
    {
        $this->authorize('update', $street);

        $street->update($request->validated());

        return new StreetResource($street);
    }

    public function destroy(Street $street)
    {
        $this->authorize('delete', $street);

        $street->delete();

        return response()->json();
    }
}
