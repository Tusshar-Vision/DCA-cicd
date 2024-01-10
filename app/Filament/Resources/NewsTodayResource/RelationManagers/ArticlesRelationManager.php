<?php

namespace App\Filament\Resources\NewsTodayResource\RelationManagers;

use App\Traits\Filament\ArticleRelationSchema;
use Filament\Resources\RelationManagers\RelationManager;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';

    use ArticleRelationSchema;
}
