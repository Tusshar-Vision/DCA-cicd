<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\RelatedTerm;
use App\Models\User;

class RelatedTermPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any RelatedTerm');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RelatedTerm $relatedterm): bool
    {
        return $user->can('view RelatedTerm');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create RelatedTerm');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RelatedTerm $relatedterm): bool
    {
        return $user->can('update RelatedTerm');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RelatedTerm $relatedterm): bool
    {
        return $user->can('delete RelatedTerm');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RelatedTerm $relatedterm): bool
    {
        return $user->can('restore RelatedTerm');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RelatedTerm $relatedterm): bool
    {
        return $user->can('force-delete RelatedTerm');
    }
}
