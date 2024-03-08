<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetroLineRequest;
use App\Http\Resources\MetroLineResource;
use App\Models\MetroLine;

class MetroLineController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', MetroLine::class);

        return MetroLineResource::collection(MetroLine::all());
    }

    public function store(MetroLineRequest $request)
    {
        $this->authorize('create', MetroLine::class);

        return new MetroLineResource(MetroLine::create($request->validated()));
    }

    public function show(MetroLine $metroLine)
    {
        $this->authorize('view', $metroLine);

        return new MetroLineResource($metroLine);
    }

    public function update(MetroLineRequest $request, MetroLine $metroLine)
    {
        $this->authorize('update', $metroLine);

        $metroLine->update($request->validated());

        return new MetroLineResource($metroLine);
    }

    public function destroy(MetroLine $metroLine)
    {
        $this->authorize('delete', $metroLine);

        $metroLine->delete();

        return response()->json();
    }
}
