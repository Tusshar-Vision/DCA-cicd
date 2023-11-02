<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\PublishedInitiative;
use App\Models\User;

class PublishedInitiativePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any PublishedInitiative');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PublishedInitiative $publishedinitiative): bool
    {
        return $user->can('view PublishedInitiative');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create PublishedInitiative');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PublishedInitiative $publishedinitiative): bool
    {
        return $user->can('update PublishedInitiative');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PublishedInitiative $publishedinitiative): bool
    {
        return $user->can('delete PublishedInitiative');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PublishedInitiative $publishedinitiative): bool
    {
        return $user->can('restore PublishedInitiative');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PublishedInitiative $publishedinitiative): bool
    {
        return $user->can('force-delete PublishedInitiative');
    }
}
