<?php

namespace App\Policies;

use App\Models\Floor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FloorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Floor $floor)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Floor $floor)
    {
    }

    public function delete(User $user, Floor $floor)
    {
    }

    public function restore(User $user, Floor $floor)
    {
    }

    public function forceDelete(User $user, Floor $floor)
    {
    }
}
