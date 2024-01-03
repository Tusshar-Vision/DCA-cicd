<?php

namespace App\Filament\Resources\MonthlyMagazineResource\RelationManagers;

use App\Traits\Filament\ArticleRelationSchema;
use Filament\Resources\RelationManagers\RelationManager;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';
    protected $listeners = ['updatedPublishedStatus' => '$refresh'];

    use ArticleRelationSchema;
}
