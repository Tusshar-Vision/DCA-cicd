<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\TopicSection;
use App\Models\User;

class TopicSectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any TopicSection');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TopicSection $topicsection): bool
    {
        return $user->can('view TopicSection');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create TopicSection');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TopicSection $topicsection): bool
    {
        return $user->can('update TopicSection');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TopicSection $topicsection): bool
    {
        return $user->can('delete TopicSection');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TopicSection $topicsection): bool
    {
        return $user->can('restore TopicSection');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TopicSection $topicsection): bool
    {
        return $user->can('force-delete TopicSection');
    }
}
