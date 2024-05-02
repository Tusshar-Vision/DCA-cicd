<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Enums\InitiativeTopics;
use App\Filament\Resources\NewsTodayResource\Pages;
use App\Filament\Resources\NewsTodayResource\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\NewsTodayResource\RelationManagers\ShortArticlesRelationManager;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Models\Video;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\InitiativeResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as Livewire;

class NewsTodayResource extends Resource implements HasShieldPermissions
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
                            ->disabled(function (?PublishedInitiative $record) {
                                if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                                else if ($record?->is_published) return true;
                            })
                            ->live(),

                    Forms\Components\TextInput::make('name')
                        ->rules([
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
                        ->required()
                        ->suffixAction(Forms\Components\Actions\Action::make('Generate')
                            ->icon('heroicon-s-cog-8-tooth')
                            ->iconButton()
                            ->action(function (callable $get, callable $set) {
                                $set('name', static::generateName($get('published_at')));
                            })
                        ),

                    ])->disabled(function (?PublishedInitiative $record) {
                        if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                        else if ($record?->is_published) return true;
                    })->columns(2)->columnSpanFull(),

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
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('news-today')
                        ->visibility('private')
                        ->openable()
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->can('upload_news::today')) return false;
                            else if ($record !== null && $record->hasMedia('news-today')) return false;
                            else return true;
                        })
                        ->deletable(function (?PublishedInitiative $record) {
                            if ($record !== null && $record->is_published === true) {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                            } else {
                                return Auth::user()->can('upload_news::today');
                            }
                        })
                        ->columnSpanFull(),

                ])->columnSpan(1),

                Forms\Components\Section::make("News Today's Video")
                    ->schema([
                        Select::make('video_id')
                            ->hiddenLabel()
                            ->searchable()
                            ->relationship('video', 'title')
                            ->createOptionForm([
                                Section::make()->schema([
                                    TextInput::make('title')->required(),
                                    Textarea::make('description')->label('Description'),
                                    SpatieTagsInput::make('tags')
                                        ->required(),

                                    Hidden::make('initiative_topic_id')
                                        ->default(InitiativesHelper::getInitiativeTopicID(InitiativeTopics::ALL))
                                        ->required()
                                ])->columnSpan(1),

                                Section::make()->schema([

                                    Toggle::make('is_url')
                                        ->label('Provide URL')
                                        ->reactive(),

                                    SpatieMediaLibraryFileUpload::make('Video')
                                        ->hidden(function (callable $get) {
                                            return $get('is_url');
                                        })
                                        ->id('video')
                                        ->collection('video')
                                        ->visibility('private')
                                        ->visible(function (?Video $record) {
                                            if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer'])) return true;
                                            else if ($record !== null && $record->hasMedia('infographic')) return true;
                                            else return false;
                                        })
                                        ->openable()
                                        ->deletable(function (?Video $record) {
                                            if ($record !== null && $record?->is_published === true) {
                                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                                            } else {
                                                return Auth::user()->hasAnyRole(['admin', 'super_admin', 'reviewer']);
                                            }
                                        })
                                        ->required()
                                        ->acceptedFileTypes([
                                            'video/mp4',         // MP4 videos
                                            'video/webm',        // WebM videos
                                            'video/ogg',
                                        ])
                                        ->previewable(),

                                    TextInput::make('url')
                                        ->visible(function (callable $get) {
                                            return $get('is_url');
                                        })
                                        ->label('Video URL')
                                        ->required()
                                        ->activeUrl(true),

                                    Group::make()->schema([

                                        Hidden::make('language_id')
                                            ->required()
                                            ->default(function (Livewire $livewire) {
                                                return $livewire->record->language_id;
                                            }),

                                    ])->columns(1),

                                    Hidden::make('author_id')->default(function () {
                                        return Auth::user()->id;
                                    })

                                ])->columnSpan(1)
                            ])
                            ->disabled(function ($operation) {
                                if ($operation === 'create') return true;
                                if (Auth::user()->can('upload_news::today')) return false;
                                else return true;
                            }),
                    ])->columnSpan(1)
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
            'index' => Pages\ListNewsTodays::route('/'),
            'create' => Pages\CreateNewsToday::route('/create'),
            'edit' => Pages\EditNewsToday::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
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
        return Auth::user()->can('view_news::today');
    }

    public static function canEdit(Model $record): bool
    {
        $userId = Auth::id(); // Get the current authenticated user's ID
        if ($record->trashed()) {
            return false;
        }
        return Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'news_today_reviewer']) || (Auth::user()->can('edit_news::today') && $record->articles->contains(function ($article) use ($userId) {
            return $article?->reviewer_id == $userId || $article->author_id == $userId;
        }));
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

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }
}
