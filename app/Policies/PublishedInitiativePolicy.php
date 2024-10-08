<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PublishedInitiative;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PublishedInitiativePolicy
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
        return $user->can('view_weekly::focus');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_weekly::focus');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function update(User $user, PublishedInitiative $publishedInitiative): bool
    {
        if ($publishedInitiative->trashed()) {
            return false;
        }
        return $user->hasAnyRole(['super_admin', 'admin', 'reviewer', 'weekly_focus_reviewer']) || ($user->can('edit_weekly::focus') && $publishedInitiative->articles->contains(function ($article) use($user) {
            return $article?->reviewer_id == $user->id || $article->author_id == $user->id;
        }));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function delete(User $user, PublishedInitiative $publishedInitiative): bool
    {
        return $user->can('delete_weekly::focus') && $publishedInitiative->is_published !== true;
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_weekly::focus');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function forceDelete(User $user, PublishedInitiative $publishedInitiative): bool
    {
        return $user->can('delete_weekly::focus') && $publishedInitiative->is_published !== true;
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('delete_weekly::focus');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function restore(User $user, PublishedInitiative $publishedInitiative): bool
    {
        return $user->can('delete_weekly::focus');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('delete_weekly::focus');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishedInitiative  $publishedInitiative
     * @return bool
     */
    public function replicate(User $user, PublishedInitiative $publishedInitiative): bool
    {
        return $user->can('{{ Replicate }}');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }

}
