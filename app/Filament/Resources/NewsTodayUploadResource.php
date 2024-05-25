<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\NewsTodayUploadResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Traits\Filament\MainUploadsPdfUploadSchema;
use App\Traits\Filament\OtherUploadsResourceSchema;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NewsTodayUploadResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?string $modelLabel = 'News Today';
    protected static ?string $pluralLabel = 'News Today';

    protected static ?int $navigationSort = 1;

    use MainUploadsPdfUploadSchema;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsTodayUploads::route('/'),
            'create' => Pages\CreateNewsTodayUpload::route('/create'),
            'edit' => Pages\EditNewsTodayUpload::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->with('articles', function ($query) {
                return $query->with(['statuses']);
            })
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_news::today');
    }

    public static function canEdit(Model $record): bool
    {
        $userId = Auth::id(); // Get the current authenticated user's ID
        if ($record->trashed()) {
            return false;
        }
        return Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'news_today_reviewer']) || (Auth::user()->can('edit_news::today') && $record->articles->contains(function ($article) use ($userId) {
                    return $article?->reviewer_id == $userId || $article->author_id == $userId;
                }));
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_news::today');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }
}
