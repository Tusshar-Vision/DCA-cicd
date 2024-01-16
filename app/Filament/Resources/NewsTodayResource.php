<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\NewsTodayResource\Pages;
use App\Filament\Resources\NewsTodayResource\RelationManagers\ArticlesRelationManager;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\InitiativeResourceSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NewsTodayResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'News Today';
    protected static ?string $pluralLabel = 'News Today';

    protected static ?int $navigationSort = 1;

    use InitiativeResourceSchema;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)),


                    Forms\Components\Group::make()->schema([
                        DatePicker::make('published_at')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label('Publish At')
                            ->required()
                            ->default(Carbon::now()->format('Y-m-d'))
                            ->rules([
                                function (PublishedInitiativeService $publishedInitiativeService, ?Model $record) {

                                    if ($record !== null) {
                                        return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService, $record) {
                                            if (
                                                Carbon::parse($record->published_at)
                                                    ->format('Y-m-d') === Carbon::parse($value)->format('Y-m-d')
                                            ) {}

                                            elseif  (
                                                $publishedInitiativeService
                                                    ->checkIfExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
                                                        $value
                                                    )
                                            ) {
                                                $fail('This date cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                            }
                                        };
                                    }

                                    return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                        if  (
                                                $publishedInitiativeService
                                                    ->checkIfExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
                                                        $value
                                                    )
                                            ) {
                                            $fail('This date cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                        }
                                    };
                                }
                            ])
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state !== null)
                                    $set('name', static::generateName($state));
                                }),

                        Forms\Components\TextInput::make('name')->default(function (callable $get) {
                            return static::generateName($get('published_at'));
                        })->rules([
                            function (PublishedInitiativeService $publishedInitiativeService, ?Model $record) {

                                if ($record !== null) {
                                    return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService, $record) {
                                        if (
                                            $record->name === $value
                                        ) {}

                                        elseif  (
                                            $publishedInitiativeService
                                                ->checkIfNameExists(
                                                    InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
                                                    $value
                                                )
                                        ) {
                                            $fail('This name cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                        }
                                    };
                                }

                                return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                    if  (
                                        $publishedInitiativeService
                                            ->checkIfNameExists(
                                                InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
                                                $value
                                            )
                                    ) {
                                        $fail('This name cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                    }
                                };
                            }
                        ])
                        ->required(),
                    ])->columns(2)->columnSpanFull(),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('news-today')
                        ->columnSpanFull(),



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
            'index' => Pages\ListNewsTodays::route('/'),
            'create' => Pages\CreateNewsToday::route('/create'),
            'edit' => Pages\EditNewsToday::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->with('articles');

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_news::today');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('edit_news::today');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_news::today');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }
}
