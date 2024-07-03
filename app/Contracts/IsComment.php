<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin Model
 */
interface IsComment
{
    public function commentable(): MorphTo;

    public function parent(): BelongsTo;

    public function children(): HasMany;

    public function user(): BelongsTo;
}
