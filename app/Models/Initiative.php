<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Initiative extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
        'name',
        'name_hindi',
        'description',
        'path',
        'parent_id',
        'order_column'
    ];

    public function published(): HasMany
    {
        return $this->hasMany(PublishedInitiative::class, 'initiative_id');
    }
}
