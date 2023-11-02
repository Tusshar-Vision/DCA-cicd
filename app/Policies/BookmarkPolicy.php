<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Bookmark;
use App\Models\User;

class BookmarkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Bookmark');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bookmark $bookmark): bool
    {
        return $user->can('view Bookmark');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Bookmark');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bookmark $bookmark): bool
    {
        return $user->can('update Bookmark');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bookmark $bookmark): bool
    {
        return $user->can('delete Bookmark');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bookmark $bookmark): bool
    {
        return $user->can('restore Bookmark');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bookmark $bookmark): bool
    {
        return $user->can('force-delete Bookmark');
    }
}
