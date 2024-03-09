<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\FilterRoomsRequest;
use App\Http\Resources\RoomResource;
use App\Services\Filters\FilterService;
use Illuminate\Http\{Request};
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function rooms(FilterRoomsRequest $request): RoomResource
    {
        $data = $request->validated();
        $filter = new FilterService(
            dealType: $data['dealType'],
        );
        return new RoomResource(null);
    }
}
