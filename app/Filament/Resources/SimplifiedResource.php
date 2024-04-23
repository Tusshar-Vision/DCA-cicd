<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\SimplifiedResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Traits\Filament\VideoResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SimplifiedResource extends Resource implements HasShieldPermissions
{
    use VideoResourceSchema;

    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Videos';

    protected static ?string $modelLabel = 'Simplified';
    protected static ?string $pluralLabel = 'Simplified';

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where(
                'initiative_id',
                InitiativesHelper::getInitiativeID(Initiatives::SIMPLIFIED_BY_VISIONIAS)
            )->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSimplifieds::route('/'),
            'create' => Pages\CreateSimplified::route('/create'),
            'edit' => Pages\EditSimplified::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'create',
            'edit',
            'delete',
            'publish'
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_simplified');
    }

    public static function canEdit(Model $record): bool
    {
        if ($record->trashed()) {
            return false;
        }
        return Auth::user()->hasAnyRole(['super_admin', 'admin']) || (Auth::user()->can('edit_simplified') && $record->is_published !== true);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_simplified');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_simplified') && $record->is_published !== true;
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_simplified');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_simplified') && $record->is_published !== true;
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_simplified');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_simplified');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_simplified');
    }
}
