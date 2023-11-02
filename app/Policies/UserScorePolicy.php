<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\UserScore;
use App\Models\User;

class UserScorePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any UserScore');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserScore $userscore): bool
    {
        return $user->can('view UserScore');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create UserScore');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserScore $userscore): bool
    {
        return $user->can('update UserScore');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserScore $userscore): bool
    {
        return $user->can('delete UserScore');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, UserScore $userscore): bool
    {
        return $user->can('restore UserScore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UserScore $userscore): bool
    {
        return $user->can('force-delete UserScore');
    }
}
