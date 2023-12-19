<?php

namespace App\Policies;

use App\Models\PublishedInitiative;
use App\Models\User;

trait NewsTodayPolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAnyNewsToday(User $user): bool
    {
        return $user->can('view_any_news::today');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function viewNewsToday(User $user, PublishedInitiative $publishedInitiative): bool
    {
        return $user->can('view_news::today');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function createNewsToday(User $user): bool
    {
        return $user->can('create_news::today');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function updateNewsToday(User $user, PublishedInitiative $publishedInitiative): bool
    {
        return $user->can('update_news::today');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function deleteNewsToday(User $user, PublishedInitiative $publishedInitiative): bool
    {
        return $user->can('delete_news::today');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAnyNewsToday(User $user): bool
    {
        return $user->can('delete_any_news::today');
    }

}
