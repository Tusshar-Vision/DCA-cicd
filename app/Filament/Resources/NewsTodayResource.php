<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsTodayResource\Pages;
use App\Filament\Resources\NewsTodayResource\RelationManagers;
use App\Filament\Resources\NewsTodayResource\RelationManagers\ArticlesRelationManager;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\NewsToday;
use App\Models\PublishedInitiative;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsTodayResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Initiatives';

    protected static ?string $modelLabel = 'News Today';

    protected static ?string $pluralLabel = 'News Today';

    protected static ?int $navigationSort = 1;

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
            'index' => Pages\ListNewsTodays::route('/'),
            'create' => Pages\CreateNewsToday::route('/create'),
            'edit' => Pages\EditNewsToday::route('/{record}/edit'),
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
