<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ArticleTag;
use App\Models\User;

class ArticleTagPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any ArticleTag');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ArticleTag $articletag): bool
    {
        return $user->can('view ArticleTag');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create ArticleTag');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ArticleTag $articletag): bool
    {
        return $user->can('update ArticleTag');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ArticleTag $articletag): bool
    {
        return $user->can('delete ArticleTag');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ArticleTag $articletag): bool
    {
        return $user->can('restore ArticleTag');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ArticleTag $articletag): bool
    {
        return $user->can('force-delete ArticleTag');
    }
}
