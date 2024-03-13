<?php

namespace App\Http\Controllers\Api;

use App\DTOs\{Filters\FilterRoomDTO};
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Services\Filters\FilterService;
use Illuminate\Http\{Request};

class FilterController extends Controller
{
    public function rooms(Request $request)
    {
        $filterRoomDTO = FilterRoomDTO::fromRequest($request);
        $filter = new FilterService($filterRoomDTO);
        return new RoomResource($filter->getPaginatedData());
    }
}
