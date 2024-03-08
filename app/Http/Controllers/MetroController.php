<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetroRequest;
use App\Http\Resources\MetroResource;
use App\Metro;

class MetroController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Metro::class);

        return MetroResource::collection(Metro::all());
    }

    public function store(MetroRequest $request)
    {
        $this->authorize('create', Metro::class);

        return new MetroResource(Metro::create($request->validated()));
    }

    public function show(Metro $metro)
    {
        $this->authorize('view', $metro);

        return new MetroResource($metro);
    }

    public function update(MetroRequest $request, Metro $metro)
    {
        $this->authorize('update', $metro);

        $metro->update($request->validated());

        return new MetroResource($metro);
    }

    public function destroy(Metro $metro)
    {
        $this->authorize('delete', $metro);

        $metro->delete();

        return response()->json();
    }
}
