<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Type;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypePolicy
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
     * Determine whether the user can view the type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Type  $type
     * @return mixed
     */
    public function view(User $user, Type $type)
    {
        //
    }

    /**
     * Determine whether the user can view the type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Type  $type
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create types.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Type  $type
     * @return mixed
     */
    public function update(User $user, Type $type)
    {
        //
    }

    /**
     * Determine whether the user can delete the type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Type  $type
     * @return mixed
     */
    public function delete(User $user, Type $type)
    {
        //
    }

    /**
     * Determine whether the user can restore the type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Type  $type
     * @return mixed
     */
    public function restore(User $user, Type $type)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Type  $type
     * @return mixed
     */
    public function forceDelete(User $user, Type $type)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Type  $type
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
