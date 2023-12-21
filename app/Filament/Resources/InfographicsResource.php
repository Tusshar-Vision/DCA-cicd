<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfographicsResource\Pages;
use App\Filament\Resources\InfographicsResource\RelationManagers;
use App\Helpers\InitiativesHelper;
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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class InfographicsResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Media';

    protected static ?string $label = 'Infographic';


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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInfographics::route('/'),
            'create' => Pages\CreateInfographics::route('/create'),
            'edit' => Pages\EditInfographics::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user->can('view_any_infographics');
    }

    public static function canView(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('view_infographics');
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('update_infographics');
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        return $user->can('create_infographics');
    }

    public static function canDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('delete_infographics');
    }

    public static function canDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_any_infographics');
    }

    public static function canForceDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('force_delete_infographics');
    }

    public static function canForceDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_any_infographics');
    }

    public static function canReorder(): bool
    {
        $user = Auth::user();
        return $user->can('reorder_infographics');
    }

    public static function canReplicate(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('replicate_infographics');
    }

    public static function canRestore(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('restore_infographics');
    }

    public static function canRestoreAny(): bool
    {
        $user = Auth::user();
        return $user->can('restore_any_infographics');
    }
}
