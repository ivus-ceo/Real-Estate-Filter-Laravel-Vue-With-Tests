<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Room $room)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Room $room)
    {
    }

    public function delete(User $user, Room $room)
    {
    }

    public function restore(User $user, Room $room)
    {
    }

    public function forceDelete(User $user, Room $room)
    {
    }
}
