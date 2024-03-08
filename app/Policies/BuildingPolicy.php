<?php

namespace App\Policies;

use App\Models\Building;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Building $building)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Building $building)
    {
    }

    public function delete(User $user, Building $building)
    {
    }

    public function restore(User $user, Building $building)
    {
    }

    public function forceDelete(User $user, Building $building)
    {
    }
}
