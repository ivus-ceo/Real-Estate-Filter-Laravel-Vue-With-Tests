<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Room;

class RoomController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Room::class);

        return RoomResource::collection(Room::all());
    }

    public function store(RoomRequest $request)
    {
        $this->authorize('create', Room::class);

        return new RoomResource(Room::create($request->validated()));
    }

    public function show(Room $room)
    {
        $this->authorize('view', $room);

        return new RoomResource($room);
    }

    public function update(RoomRequest $request, Room $room)
    {
        $this->authorize('update', $room);

        $room->update($request->validated());

        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        $this->authorize('delete', $room);

        $room->delete();

        return response()->json();
    }
}
