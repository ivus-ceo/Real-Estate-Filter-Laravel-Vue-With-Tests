<?php

namespace App\Policies;

use App\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, City $city)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, City $city)
    {
    }

    public function delete(User $user, City $city)
    {
    }

    public function restore(User $user, City $city)
    {
    }

    public function forceDelete(User $user, City $city)
    {
    }
}
