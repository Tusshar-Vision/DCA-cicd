<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelatedTermsResource\Pages;
use App\Models\RelatedTerm;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RelatedTermResource extends Resource
{
    protected static ?string $model = RelatedTerm::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Create Articles';

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
            'index' => Pages\ListRelatedTerms::route('/'),
            'create' => Pages\CreateRelatedTerms::route('/create'),
            'edit' => Pages\EditRelatedTerms::route('/{record}/edit'),
        ];
    }
}
