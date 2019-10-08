<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Garage;
use Illuminate\Auth\Access\HandlesAuthorization;

class GaragePolicy
{
    use HandlesAuthorization;

    /**
     * filter function
     *
     * @param [type] $user
     * @param [type] $ability
     * @return void
     */
    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the garage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Garage  $garage
     * @return mixed
     */
    public function view(User $user, Garage $garage)
    {
        //
    }

    /**
     * Determine whether the user can view the garage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Garage  $garage
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create garages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the garage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Garage  $garage
     * @return mixed
     */
    public function update(User $user, Garage $garage)
    {
        //
    }

    /**
     * Determine whether the user can delete the garage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Garage  $garage
     * @return mixed
     */
    public function delete(User $user, Garage $garage)
    {
        //
    }

    /**
     * Determine whether the user can restore the garage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Garage  $garage
     * @return mixed
     */
    public function restore(User $user, Garage $garage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the garage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Garage  $garage
     * @return mixed
     */
    public function forceDelete(User $user, Garage $garage)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the garage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Garage  $garage
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
