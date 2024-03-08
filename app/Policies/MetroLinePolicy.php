<?php

namespace App\Policies;

use App\Models\MetroLine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetroLinePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, MetroLine $metroLine)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, MetroLine $metroLine)
    {
    }

    public function delete(User $user, MetroLine $metroLine)
    {
    }

    public function restore(User $user, MetroLine $metroLine)
    {
    }

    public function forceDelete(User $user, MetroLine $metroLine)
    {
    }
}
