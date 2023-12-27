<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\WeeklyFocusResource\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\WeeklyFocusResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use App\Traits\Filament\InitiativeResourceSchema;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WeeklyFocusResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'Weekly Focus';
    protected static ?string $pluralLabel = 'Weekly Focus';

    protected static ?int $navigationSort = 2;

    use InitiativeResourceSchema;

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
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)),
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
        $query = static::getModel()::query()->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS));

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

}
