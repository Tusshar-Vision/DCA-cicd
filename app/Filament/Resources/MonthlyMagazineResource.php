<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\MonthlyMagazineResource\Pages;
use App\Filament\Resources\MonthlyMagazineResource\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\MonthlyMagazineResource\RelationManagers\ShortArticlesRelationManager;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\InitiativeResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class MonthlyMagazineResource extends Resource implements HasShieldPermissions
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
                            ->disabled(function (?PublishedInitiative $record) {
                                if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                                else if ($record?->is_published) return true;
                            })
                            ->live()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $publishAt = $get('published_at');
                                if ($publishAt) {
                                    $set('publication_date', Carbon::createFromFormat('Y-m-d h:i:s', ($publishAt))->subMonth());
                                }
                            }),

                        Forms\Components\TextInput::make('name')->rules([
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
                        ->required()
                        ->suffixAction(Forms\Components\Actions\Action::make('Generate')
                            ->icon('heroicon-s-cog-8-tooth')
                            ->iconButton()
                            ->action(function (callable $get, callable $set) {
                                $set('name', static::generateName($get('published_at')));
                            })
                        ),
                    ])
                    ->columns()
                    ->disabled(function (?PublishedInitiative $record) {
                        if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                        else if ($record?->is_published) return true;
                    })
                    ->columnSpanFull(),

//                    Select::make('language_id')
//                        ->relationship('language', 'name', function ($query) {
//                            return $query->orderBy('order_column');
//                        })
//                        ->label('Language')
//                        ->required()
//                        ->selectablePlaceholder(false)
//                        ->default(1),

                    Hidden::make('language_id')->default(1),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->collection('monthly-magazine')
                        ->acceptedFileTypes(['application/pdf'])
                        ->visibility('private')
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->can('upload_monthly::magazine')) return false;
                            else if ($record !== null && $record->hasMedia('monthly-magazine')) return false;
                            else return true;
                        })
                        ->openable()
                        ->deletable(function (?PublishedInitiative $record) {
                            if ($record !== null && $record->is_published === true) {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                            } else {
                                return Auth::user()->can('upload_monthly::magazine');
                            }
                        }),

                    Forms\Components\DatePicker::make('publication_date')
                        ->label('Issue Month')
                        ->native(false)
                        ->displayFormat('M, Y')
                        ->closeOnDateSelection()
                        ->default(function (callable $get) {
                            return Carbon::createFromFormat('Y-m-d H:i:s', ($get('published_at')))->subMonth();
                        })
                        ->required()
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                            else if ($record?->is_published) return true;
                        }),

                ])
                ->columns(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ArticlesRelationManager::class,
            ShortArticlesRelationManager::class
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
            ->with('articles', function ($query) {
                return $query->with(['statuses']);
            })
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'create',
            'edit',
            'upload',
            'assign',
            'delete',
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_monthly::magazine');
    }

    public static function canEdit(Model $record): bool
    {
        $userId = Auth::id(); // Get the current authenticated user's ID
        if ($record->trashed()) {
            return false;
        }
        return Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'monthly_magazine_reviewer']) || (Auth::user()->can('edit_monthly::magazine') && ($record->articles->contains(function ($article) use ($userId) {
            return $article?->reviewer_id == $userId || $article->author_id == $userId;
        }))) || $record->shortArticles->contains(function ($article) use ($userId) {
                return $article?->reviewer_id == $userId || $article->author_id == $userId;
        });
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

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_monthly::magazine');
    }
}
