<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TopicSection;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicSectionPolicy
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
        return $user->can('view_section');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_section');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TopicSection  $topicSection
     * @return bool
     */
    public function update(User $user, TopicSection $topicSection): bool
    {
        return $user->can('edit_section');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TopicSection  $topicSection
     * @return bool
     */
    public function delete(User $user, TopicSection $topicSection): bool
    {
        return $user->can('delete_section');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_section');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TopicSection  $topicSection
     * @return bool
     */
    public function forceDelete(User $user, TopicSection $topicSection): bool
    {
        return $user->can('delete_section');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('delete_section');
    }
}
