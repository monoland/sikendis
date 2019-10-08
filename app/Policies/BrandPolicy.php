<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
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
     * Determine whether the user can view the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brand  $brand
     * @return mixed
     */
    public function view(User $user, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can view the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brand  $brand
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create brands.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brand  $brand
     * @return mixed
     */
    public function update(User $user, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can delete the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brand  $brand
     * @return mixed
     */
    public function delete(User $user, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can restore the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brand  $brand
     * @return mixed
     */
    public function restore(User $user, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brand  $brand
     * @return mixed
     */
    public function forceDelete(User $user, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the brand.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Brand  $brand
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
