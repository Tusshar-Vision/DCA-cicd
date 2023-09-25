<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeeklyFocusResource\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\WeeklyFocusResource\Pages;
use App\Filament\Resources\WeeklyFocusResource\RelationManagers;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeeklyFocusResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Initiatives';

    protected static ?string $modelLabel = 'Weekly Focus';

    protected static ?string $pluralLabel = 'Weekly Focus';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('initiative_id')
                ->relationship('initiative', 'name')->required(),
                DatePicker::make('published_at')->label('Published At'),
                FileUpload::make('magazine_pdf_url')->label('Magazine PDF')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('published_at')->dateTime('d M Y h:m')->label('Published At')->sortable(),
                TextColumn::make('updated_at')->dateTime('d M Y h:m')->label('Last Updated')->sortable(),
                TextColumn::make('magazine_pdf_url')->label('Magazine PDF URL')
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
            ArticlesRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeeklyFoci::route('/'),
            'create' => Pages\CreateWeeklyFocus::route('/create'),
            'edit' => Pages\EditWeeklyFocus::route('/{record}/edit'),
        ];
    }    

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()->where('initiative_id', InitiativesHelper::getInitiativeID(static::getModelLabel()));

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }
}
