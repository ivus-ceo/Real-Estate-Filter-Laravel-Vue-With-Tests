<?php

namespace App\Policies;

use App\MetroStation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetroStationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, MetroStation $metroStation)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, MetroStation $metroStation)
    {
    }

    public function delete(User $user, MetroStation $metroStation)
    {
    }

    public function restore(User $user, MetroStation $metroStation)
    {
    }

    public function forceDelete(User $user, MetroStation $metroStation)
    {
    }
}
