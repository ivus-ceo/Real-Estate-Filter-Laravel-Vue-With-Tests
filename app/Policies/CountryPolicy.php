<?php

namespace App\Policies;

use App\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Country $country)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Country $country)
    {
    }

    public function delete(User $user, Country $country)
    {
    }

    public function restore(User $user, Country $country)
    {
    }

    public function forceDelete(User $user, Country $country)
    {
    }
}
