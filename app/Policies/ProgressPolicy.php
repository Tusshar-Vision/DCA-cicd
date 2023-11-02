<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Progress;
use App\Models\User;

class ProgressPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Progress');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Progress $progress): bool
    {
        return $user->can('view Progress');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Progress');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Progress $progress): bool
    {
        return $user->can('update Progress');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Progress $progress): bool
    {
        return $user->can('delete Progress');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Progress $progress): bool
    {
        return $user->can('restore Progress');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Progress $progress): bool
    {
        return $user->can('force-delete Progress');
    }
}
