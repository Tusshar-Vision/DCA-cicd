<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use App\Contracts\IsComment;

/**
 * @mixin Model
 */
trait HasComments
{
    /** @return MorphMany<IsComment> */
    public function comments(): MorphMany
    {
        return $this->morphMany(config('comments.model'), 'commentable');
    }

    public function comment(string $content, Model $user = null, IsComment $parent = null): IsComment
    {
        return $this->comments()->create([
            'content' => $content,
            'user_id' => $user ? $user->getKey() : Auth::id(),
            'parent_id' => $parent?->getKey(),
        ]);
    }
}
