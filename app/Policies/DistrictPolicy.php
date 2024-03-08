<?php

namespace App\Policies;

use App\District;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DistrictPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, District $district)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, District $district)
    {
    }

    public function delete(User $user, District $district)
    {
    }

    public function restore(User $user, District $district)
    {
    }

    public function forceDelete(User $user, District $district)
    {
    }
}
