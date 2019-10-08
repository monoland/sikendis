<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agency;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgencyPolicy
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
     * Determine whether the user can view the agency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agency  $agency
     * @return mixed
     */
    public function view(User $user, Agency $agency)
    {
        //
    }

    /**
     * Determine whether the user can view the agency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agency  $agency
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create agencies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the agency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agency  $agency
     * @return mixed
     */
    public function update(User $user, Agency $agency)
    {
        //
    }

    /**
     * Determine whether the user can delete the agency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agency  $agency
     * @return mixed
     */
    public function delete(User $user, Agency $agency)
    {
        //
    }

    /**
     * Determine whether the user can restore the agency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agency  $agency
     * @return mixed
     */
    public function restore(User $user, Agency $agency)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the agency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agency  $agency
     * @return mixed
     */
    public function forceDelete(User $user, Agency $agency)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the agency.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agency  $agency
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
