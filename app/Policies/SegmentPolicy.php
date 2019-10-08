<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Segment;
use Illuminate\Auth\Access\HandlesAuthorization;

class SegmentPolicy
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
     * Determine whether the user can view the segment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function view(User $user, Segment $segment)
    {
        //
    }

    /**
     * Determine whether the user can view the segment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create segments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the segment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function update(User $user, Segment $segment)
    {
        //
    }

    /**
     * Determine whether the user can delete the segment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function delete(User $user, Segment $segment)
    {
        //
    }

    /**
     * Determine whether the user can restore the segment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function restore(User $user, Segment $segment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the segment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function forceDelete(User $user, Segment $segment)
    {
        //
    }

    /**
     * Determine whether the user can bulk delete the segment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function bulkDelete(User $user)
    {
        //
    }
}
