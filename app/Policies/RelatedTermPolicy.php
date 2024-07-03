<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RelatedTerm;
use Illuminate\Auth\Access\HandlesAuthorization;

class RelatedTermPolicy
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
        return $user->can('view_related::term');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelatedTerm  $relatedTerm
     * @return bool
     */
    public function view(User $user, RelatedTerm $relatedTerm): bool
    {
        return $user->can('view_related::term');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_related::term');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelatedTerm  $relatedTerm
     * @return bool
     */
    public function update(User $user, RelatedTerm $relatedTerm): bool
    {
        return $user->can('edit_related::term');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelatedTerm  $relatedTerm
     * @return bool
     */
    public function delete(User $user, RelatedTerm $relatedTerm): bool
    {
        return $user->can('delete_related::term');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_related::term');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelatedTerm  $relatedTerm
     * @return bool
     */
    public function forceDelete(User $user, RelatedTerm $relatedTerm): bool
    {
        return $user->can('delete_related::term');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('delete_related::term');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RelatedTerm  $relatedTerm
     * @return bool
     */
    public function restore(User $user, RelatedTerm $relatedTerm): bool
    {
        return $user->can('delete_related::term');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('delete_related::term');
    }
}
