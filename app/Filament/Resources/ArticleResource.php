<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Traits\Filament\ArticleResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ArticleResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'All Article';
    protected static ?int $navigationSort = 4;
    protected static ?string $recordRouteKeyName = 'id';

    use ArticleResourceSchema;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['statuses', 'author', 'reviewer'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

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
            'assign',
            'review',
            'publish'
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_article');
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();
        return
            (
                $user->can('edit_article') && ($record->status !== 'Published')
            ) && (
                $record->reviewer_id === $user->id || ($record->author_id === $user->id && $record->status !== 'Final') || $user->hasRole(['admin', 'super_admin'])
            );
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_article');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_article');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_article');

    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_article');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_article');
    }

    public static function canReorder(): bool
    {
        return Auth::user()->can('reorder_article');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('restore_article');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('restore_article');
    }
}
