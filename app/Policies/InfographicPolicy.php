<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Infographic;
use Illuminate\Auth\Access\HandlesAuthorization;

class InfographicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_infographics');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_infographics');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Infographic  $infographic
     * @return bool
     */
    public function update(User $user, Infographic $infographic): bool
    {
        if ($infographic->trashed()) {
            return false;
        }
        return $user->can('edit_infographics');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Infographic  $infographic
     * @return bool
     */
    public function delete(User $user, Infographic $infographic): bool
    {
        return $user->can('delete_infographics');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_infographics');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Infographic  $infographic
     * @return bool
     */
    public function forceDelete(User $user, Infographic $infographic): bool
    {
        return $user->can('delete_infographics');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('delete_infographics');
    }
}
