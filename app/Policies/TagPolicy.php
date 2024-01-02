<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Tags\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
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
        return $user->can('view_tags');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_tags');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Tags\Tag  $tag
     * @return bool
     */
    public function update(User $user, Tag $tag): bool
    {
        return $user->can('edit_tags');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Tags\Tag  $tag
     * @return bool
     */
    public function delete(User $user, Tag $tag): bool
    {
        return $user->can('delete_tags');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_tags');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Tags\Tag  $tag
     * @return bool
     */
    public function forceDelete(User $user, Tag $tag): bool
    {
        return $user->can('delete_tags');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('delete_tags');
    }
}
