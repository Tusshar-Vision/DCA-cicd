<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\TopicSubSection;
use App\Models\User;

class TopicSubSectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any TopicSubSection');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TopicSubSection $topicsubsection): bool
    {
        return $user->can('view TopicSubSection');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create TopicSubSection');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TopicSubSection $topicsubsection): bool
    {
        return $user->can('update TopicSubSection');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TopicSubSection $topicsubsection): bool
    {
        return $user->can('delete TopicSubSection');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TopicSubSection $topicsubsection): bool
    {
        return $user->can('restore TopicSubSection');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TopicSubSection $topicsubsection): bool
    {
        return $user->can('force-delete TopicSubSection');
    }
}
