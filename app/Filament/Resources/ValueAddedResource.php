<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ValueAddedResource\Pages;
use App\Filament\Resources\ValueAddedResource\RelationManagers;
use App\Models\PublishedInitiative;
use App\Models\ValueAdded;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ValueAddedResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 8;

    protected static ?string $modelLabel = 'Value Added Material';

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

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
            'index' => Pages\ListValueAddeds::route('/'),
            'create' => Pages\CreateValueAdded::route('/create'),
            'edit' => Pages\EditValueAdded::route('/{record}/edit'),
        ];
    }
}
