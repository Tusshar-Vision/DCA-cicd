<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Traits\Filament\ArticleResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Resources\Resource;

class ArticleResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'All Article';
    protected static ?int $navigationSort = 4;

    use ArticleResourceSchema;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'create',
            'edit',
            'delete',
            'restore',
            'reorder',
            'review',
            'publish'
        ];
    }
}
