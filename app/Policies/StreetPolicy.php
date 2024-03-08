<?php

namespace App\Policies;

use App\Models\Street;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StreetPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Street $street)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Street $street)
    {
    }

    public function delete(User $user, Street $street)
    {
    }

    public function restore(User $user, Street $street)
    {
    }

    public function forceDelete(User $user, Street $street)
    {
    }
}
