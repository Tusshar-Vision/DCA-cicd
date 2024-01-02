<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfographicsResource\Pages;
use App\Filament\Resources\InfographicsResource\RelationManagers;
use App\Helpers\InitiativesHelper;
use App\Models\Infographic;
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
    protected static ?string $model = Infographic::class;

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
        return Auth::user()->can('view_infographics');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('edit_infographics');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_infographics');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_infographics');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_infographics');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_infographics');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_infographics');
    }
}
