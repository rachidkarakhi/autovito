<?php

namespace App\Policies;

use App\User;
use App\Annance;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the annance.
     *
     * @param  \App\User  $user
     * @param  \App\Annance  $annance
     * @return mixed
     */
    public function view(User $user, Annance $annance)
    {
        //
    }

    /**
     * Determine whether the user can create annances.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the annance.
     *
     * @param  \App\User  $user
     * @param  \App\Annance  $annance
     * @return mixed
     */
    public function update(User $user, Annance $annance)
    {
        return $user->id===$annance->user_id;
    }

    /**
     * Determine whether the user can delete the annance.
     *
     * @param  \App\User  $user
     * @param  \App\Annance  $annance
     * @return mixed
     */
    public function delete(User $user, Annance $annance)
    {
        //
    }

    /**
     * Determine whether the user can restore the annance.
     *
     * @param  \App\User  $user
     * @param  \App\Annance  $annance
     * @return mixed
     */
    public function restore(User $user, Annance $annance)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the annance.
     *
     * @param  \App\User  $user
     * @param  \App\Annance  $annance
     * @return mixed
     */
    public function forceDelete(User $user, Annance $annance)
    {
        //
    }
}
