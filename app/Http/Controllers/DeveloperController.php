<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeveloperRequest;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;

class DeveloperController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Developer::class);

        return DeveloperResource::collection(Developer::all());
    }

    public function store(DeveloperRequest $request)
    {
        $this->authorize('create', Developer::class);

        return new DeveloperResource(Developer::create($request->validated()));
    }

    public function show(Developer $developer)
    {
        $this->authorize('view', $developer);

        return new DeveloperResource($developer);
    }

    public function update(DeveloperRequest $request, Developer $developer)
    {
        $this->authorize('update', $developer);

        $developer->update($request->validated());

        return new DeveloperResource($developer);
    }

    public function destroy(Developer $developer)
    {
        $this->authorize('delete', $developer);

        $developer->delete();

        return response()->json();
    }
}
