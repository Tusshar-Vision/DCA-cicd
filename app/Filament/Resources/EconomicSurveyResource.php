<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EconomicSurveyResource\Pages;
use App\Filament\Resources\EconomicSurveyResource\RelationManagers;
use App\Models\EconomicSurvey;
use App\Models\PublishedInitiative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EconomicSurveyResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 7;

    protected static ?string $modelLabel = 'Economic Survey & Budget';

    protected static ?string $navigationIcon = 'heroicon-o-currency-rupee';

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
            'index' => Pages\ListEconomicSurveys::route('/'),
            'create' => Pages\CreateEconomicSurvey::route('/create'),
            'edit' => Pages\EditEconomicSurvey::route('/{record}/edit'),
        ];
    }
}
