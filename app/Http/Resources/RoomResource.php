<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Room */
class RoomResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'name' => $this->name,

            'floor' => new FloorResource($this->whenLoaded('floor')),
            'building' => new BuildingResource($this->whenLoaded('building')),
        ];
    }
}
