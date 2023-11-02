<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ArticleSource;
use App\Models\User;

class ArticleSourcePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any ArticleSource');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ArticleSource $articlesource): bool
    {
        return $user->can('view ArticleSource');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create ArticleSource');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ArticleSource $articlesource): bool
    {
        return $user->can('update ArticleSource');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ArticleSource $articlesource): bool
    {
        return $user->can('delete ArticleSource');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ArticleSource $articlesource): bool
    {
        return $user->can('restore ArticleSource');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ArticleSource $articlesource): bool
    {
        return $user->can('force-delete ArticleSource');
    }
}
