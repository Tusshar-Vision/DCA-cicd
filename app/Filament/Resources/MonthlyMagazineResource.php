<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\MonthlyMagazineResource\Pages;
use App\Filament\Resources\MonthlyMagazineResource\RelationManagers\ArticlesRelationManager;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\InitiativeResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Carbon\Carbon;
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

class MonthlyMagazineResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'Monthly Magazine';

    protected static ?int $navigationSort = 3;

    use InitiativeResourceSchema;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE)),


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
                                        return function (string $attribute, $value, \Closure $fail) use ($publishedInitiativeService, $record) {
                                            if (
                                                Carbon::parse($record->published_at)
                                                    ->format('Y-m-d') === Carbon::parse($value)->format('Y-m-d')
                                            ) {
                                            } elseif (
                                                $publishedInitiativeService
                                                    ->checkIfExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE),
                                                        $value
                                                    )
                                            ) {
                                                $fail('This month cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                            }
                                        };
                                    }

                                    return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                        if  (
                                            $publishedInitiativeService
                                                ->checkIfExists(
                                                    InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE),
                                                    $value
                                                )
                                        ) {
                                            $fail('This month cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
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
                                                    InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE),
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
                                                InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE),
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

                    Select::make('language_id')
                        ->relationship('language', 'name', function ($query) {
                            return $query->orderBy('order_column');
                        })
                        ->label('Language')
                        ->required()
                        ->default(1),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->collection('monthly-magazine')
                        ->acceptedFileTypes(['application/pdf'])
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
            'index' => Pages\ListMonthlyMagazines::route('/'),
            'create' => Pages\CreateMonthlyMagazine::route('/create'),
            'edit' => Pages\EditMonthlyMagazine::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE))
            ->with('articles');;

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_monthly::magazine');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('edit_monthly::magazine');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_monthly::magazine');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }
}
