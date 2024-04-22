<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SimplifiedResource\Pages;
use App\Filament\Resources\SimplifiedResource\RelationManagers;
use App\Models\PublishedInitiative;
use App\Models\Simplified;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SimplifiedResource extends Resource
{
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSimplifieds::route('/'),
            'create' => Pages\CreateSimplified::route('/create'),
            'edit' => Pages\EditSimplified::route('/{record}/edit'),
        ];
    }
}
