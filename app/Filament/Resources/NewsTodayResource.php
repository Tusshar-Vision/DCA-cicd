<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\NewsTodayResource\Pages;
use App\Filament\Resources\NewsTodayResource\RelationManagers;
use App\Filament\Resources\NewsTodayResource\RelationManagers\ArticlesRelationManager;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

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
                Forms\Components\Section::make('New Initiative')->schema([
                    Select::make('initiative_id')
                        ->options([
                            1 => 'News Today',
                            2 => 'Monthly Magazine',
                            3 => 'Weekly Focus'
                        ])
                        ->required()
                        ->label('Initiative')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)),
                    DatePicker::make('published_at')->default(today())->reactive(),
                    Toggle::make('is_published')->inline(false)->afterStateUpdated(function ($state, $livewire, ?Model $record, Article $articles, callable $get) {
                        $publishedInitiativeId = $record->id;
                        $publishedAt = $get('published_at');

                        $articles->where('published_initiative_id', '=', $publishedInitiativeId)->update([
                            'is_published' => $state,
                            'published_at' => $publishedAt,
                            'publisher_id' => Auth::user()->id
                        ]);
                        $livewire->dispatch('updatedPublishedStatus');
                    }),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('published_at')->dateTime('d M Y h:m')->label('Published At')->sortable(),
                ToggleColumn::make('is_published')->label('Is Published')->sortable()->afterStateUpdated(function ($state, ?Model $record, Article $articles) {
                    $publishedInitiativeId = $record->id;

                    $articles->where('published_initiative_id', '=', $publishedInitiativeId)->update([
                        'is_published' => $state,
                        'published_at' => $record->published_at,
                        'publisher_id' => Auth::user()->id
                    ]);
                }),
                TextColumn::make('updated_at')->dateTime('d M Y h:m')->label('Last Updated')->sortable(),
            ])->defaultSort('published_at', 'desc')
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
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY));

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }
}
