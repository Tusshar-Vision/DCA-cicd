<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonalityInFocusResource\Pages;
use App\Filament\Resources\PersonalityInFocusResource\RelationManagers;
use App\Models\PersonalityInFocus;
use App\Models\PublishedInitiative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonalityInFocusResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Videos';

    protected static ?string $modelLabel = 'Personality In Focus';
    protected static ?string $pluralLabel = 'Personality In Focus';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

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
            'index' => Pages\ListPersonalityInFoci::route('/'),
            'create' => Pages\CreatePersonalityInFocus::route('/create'),
            'edit' => Pages\EditPersonalityInFocus::route('/{record}/edit'),
        ];
    }
}
