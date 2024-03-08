<?php

namespace App\Policies;

use App\Models\Region;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Region $region)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Region $region)
    {
    }

    public function delete(User $user, Region $region)
    {
    }

    public function restore(User $user, Region $region)
    {
    }

    public function forceDelete(User $user, Region $region)
    {
    }
}
