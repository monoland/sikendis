<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Police;
use Illuminate\Auth\Access\HandlesAuthorization;

class PolicePolicy
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
     * Determine whether the user can view the police.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Police  $police
     * @return mixed
     */
    public function view(User $user, Police $police)
    {
        //
    }

    /**
     * Determine whether the user can view the police.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Police  $police
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create police.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the police.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Police  $police
     * @return mixed
     */
    public function update(User $user, Police $police)
    {
        //
    }

    /**
     * Determine whether the user can delete the police.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Police  $police
     * @return mixed
     */
    public function delete(User $user, Police $police)
    {
        //
    }

    /**
     * Determine whether the user can restore the police.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Police  $police
     * @return mixed
     */
    public function restore(User $user, Police $police)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the police.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Police  $police
     * @return mixed
     */
    public function forceDelete(User $user, Police $police)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the police.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Police  $police
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
