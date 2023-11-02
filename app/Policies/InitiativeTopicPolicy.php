<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\InitiativeTopic;
use App\Models\User;

class InitiativeTopicPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any InitiativeTopic');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InitiativeTopic $initiativetopic): bool
    {
        return $user->can('view InitiativeTopic');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create InitiativeTopic');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InitiativeTopic $initiativetopic): bool
    {
        return $user->can('update InitiativeTopic');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InitiativeTopic $initiativetopic): bool
    {
        return $user->can('delete InitiativeTopic');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InitiativeTopic $initiativetopic): bool
    {
        return $user->can('restore InitiativeTopic');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InitiativeTopic $initiativetopic): bool
    {
        return $user->can('force-delete InitiativeTopic');
    }
}
