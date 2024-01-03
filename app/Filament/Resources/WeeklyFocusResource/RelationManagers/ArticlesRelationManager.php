<?php

namespace App\Filament\Resources\WeeklyFocusResource\RelationManagers;

use App\Traits\Filament\ArticleRelationSchema;
use Filament\Resources\RelationManagers\RelationManager;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';
    protected static ?string $title = 'Sections';
    protected static ?string $label = 'section';

    use ArticleRelationSchema;
}
