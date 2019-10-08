<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
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
     * Determine whether the user can view the service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function view(User $user, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can view the service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create services.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function update(User $user, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can delete the service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function delete(User $user, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can restore the service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function restore(User $user, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function forceDelete(User $user, Service $service)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the service.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
