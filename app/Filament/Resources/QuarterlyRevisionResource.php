<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuarterlyRevisionResource\Pages;
use App\Filament\Resources\QuarterlyRevisionResource\RelationManagers;
use App\Models\PublishedInitiative;
use App\Models\QuarterlyRevision;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuarterlyRevisionResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Quarterly Revision Document';

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

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
            'index' => Pages\ListQuarterlyRevisions::route('/'),
            'create' => Pages\CreateQuarterlyRevision::route('/create'),
            'edit' => Pages\EditQuarterlyRevision::route('/{record}/edit'),
        ];
    }
}
