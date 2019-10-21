<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * filter function.
     *
     * @param [type] $user
     * @param [type] $ability
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
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function view(User $user, Service $service)
    {
    }

    /**
     * Determine whether the user can view the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create services.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isOperator();
    }

    /**
     * Determine whether the user can create services.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function examine(User $user)
    {
        return $user->isPPTK();
    }

    /**
     * Determine whether the user can create services.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function approval(User $user)
    {
        return $user->isKPA();
    }

    /**
     * Determine whether the user can update the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function update(User $user, Service $service)
    {
    }

    /**
     * Determine whether the user can update the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function submission(User $user, Service $service)
    {
        return $user->isKabiro() && $service->agency_id === $user->userable->id;
    }

    /**
     * Determine whether the user can update the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function workorder(User $user, Service $service)
    {
        return $user->isOperator() && $service->agency_id === $user->userable->id;
    }

    /**
     * Determine whether the user can delete the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function delete(User $user, Service $service)
    {
    }

    /**
     * Determine whether the user can restore the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function restore(User $user, Service $service)
    {
    }

    /**
     * Determine whether the user can permanently delete the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function forceDelete(User $user, Service $service)
    {
    }

    /**
     * Determine whether the user can bulk delete the service.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Service $service
     *
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
    }
}
