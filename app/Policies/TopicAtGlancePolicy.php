<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\TopicAtGlance;
use App\Models\User;

class TopicAtGlancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any TopicAtGlance');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TopicAtGlance $topicatglance): bool
    {
        return $user->can('view TopicAtGlance');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create TopicAtGlance');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TopicAtGlance $topicatglance): bool
    {
        return $user->can('update TopicAtGlance');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TopicAtGlance $topicatglance): bool
    {
        return $user->can('delete TopicAtGlance');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TopicAtGlance $topicatglance): bool
    {
        return $user->can('restore TopicAtGlance');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TopicAtGlance $topicatglance): bool
    {
        return $user->can('force-delete TopicAtGlance');
    }
}
