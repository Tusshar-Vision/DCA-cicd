<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\RelatedVideo;
use App\Models\User;

class RelatedVideoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any RelatedVideo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RelatedVideo $relatedvideo): bool
    {
        return $user->can('view RelatedVideo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create RelatedVideo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RelatedVideo $relatedvideo): bool
    {
        return $user->can('update RelatedVideo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RelatedVideo $relatedvideo): bool
    {
        return $user->can('delete RelatedVideo');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RelatedVideo $relatedvideo): bool
    {
        return $user->can('restore RelatedVideo');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RelatedVideo $relatedvideo): bool
    {
        return $user->can('force-delete RelatedVideo');
    }
}
