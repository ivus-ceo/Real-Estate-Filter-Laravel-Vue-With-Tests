<?php

namespace App\Policies;

use App\BuildingFloor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildingFloorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, BuildingFloor $buildingFloor)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, BuildingFloor $buildingFloor)
    {
    }

    public function delete(User $user, BuildingFloor $buildingFloor)
    {
    }

    public function restore(User $user, BuildingFloor $buildingFloor)
    {
    }

    public function forceDelete(User $user, BuildingFloor $buildingFloor)
    {
    }
}
