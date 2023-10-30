<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Initiative;
use App\Models\User;

class InitiativePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Initiative');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Initiative $initiative): bool
    {
        return $user->can('view Initiative');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Initiative');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Initiative $initiative): bool
    {
        return $user->can('update Initiative');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Initiative $initiative): bool
    {
        return $user->can('delete Initiative');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Initiative $initiative): bool
    {
        return $user->can('restore Initiative');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Initiative $initiative): bool
    {
        return $user->can('force-delete Initiative');
    }
}
