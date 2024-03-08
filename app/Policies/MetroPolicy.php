<?php

namespace App\Policies;

use App\Metro;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetroPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Metro $metro)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Metro $metro)
    {
    }

    public function delete(User $user, Metro $metro)
    {
    }

    public function restore(User $user, Metro $metro)
    {
    }

    public function forceDelete(User $user, Metro $metro)
    {
    }
}
