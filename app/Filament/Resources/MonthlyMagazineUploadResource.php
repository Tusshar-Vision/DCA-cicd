<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\MonthlyMagazineUploadResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Traits\Filament\MainUploadsPdfUploadSchema;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class MonthlyMagazineUploadResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Other Uploads';
    protected static ?string $modelLabel = 'Monthly Magazine';

    protected static ?int $navigationSort = 3;

    use MainUploadsPdfUploadSchema;


    public static function form(Form $form): Form
    {
        return MonthlyMagazineResource::form($form);
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
            'index' => Pages\ListMonthlyMagazineUploads::route('/'),
            'create' => Pages\CreateMonthlyMagazineUpload::route('/create'),
            'edit' => Pages\EditMonthlyMagazineUpload::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))
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
        return Auth::user()->can('view_monthly::magazine');
    }

    public static function canEdit(Model $record): bool
    {
        $userId = Auth::id(); // Get the current authenticated user's ID
        if ($record->trashed()) {
            return false;
        }
        return Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'monthly_magazine_reviewer']) || (Auth::user()->can('edit_monthly::magazine') && $record->articles->contains(function ($article) use ($userId) {
                    return $article?->reviewer_id == $userId || $article->author_id == $userId;
                }));
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_monthly::magazine');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_monthly::magazine') && $record->is_published !== true;
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_monthly::magazine') && $record->is_published !== true;
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }
}
