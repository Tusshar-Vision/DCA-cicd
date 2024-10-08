<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Components\SourceInput;
use App\Filament\Resources\WeeklyFocusUploadResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\MainUploadsPdfUploadSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class WeeklyFocusUploadResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Other Uploads';
    protected static ?string $modelLabel = 'Weekly Focus';
    protected static ?string $pluralLabel = 'Weekly Focus';
    protected static ?int $navigationSort = 2;

    use MainUploadsPdfUploadSchema;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General')->schema([

                    Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)),

                    Group::make()->schema([
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

                                            else if  (
                                                $publishedInitiativeService
                                                    ->checkIfExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
                                                        $value
                                                    )
                                            ) {
                                                $fail('This week cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                            }
                                        };
                                    }

                                    return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                        if  (
                                            $publishedInitiativeService
                                                ->checkIfExists(
                                                    InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
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

                        TextInput::make('name')
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
                                                        InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
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
                                                    InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
                                                    $value
                                                )
                                        ) {
                                            $fail('This name cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                        }
                                    };
                                }
                            ])
                            ->suffixAction(Action::make('Generate')
                                ->icon('heroicon-s-cog-8-tooth')
                                ->iconButton()
                                ->action(function (callable $get, callable $set) {
                                    $set('name', static::generateName($get('published_at')));
                                })
                            )
                            ->required(),

                    ])->disabled(function (?PublishedInitiative $record) {
                        if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                        else if ($record?->is_published) return true;
                    })->columns(2)->columnSpanFull(),

                    Select::make('initiative_topic_id')
                        ->relationship('topic', 'name', function ($query) {
                            $query->where('name', '!=', 'All');
                        })
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Subject')
                        ->reactive()
                        ->columnSpanFull()
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            $set('topic_section_id', null);
                            $set('topic_sub_section_id', null);
                        })->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                            else if ($record?->is_published) return true;
                        }),

                    Select::make('topic_section_id')
                        ->searchable()
                        ->preload()
                        ->relationship('topicSection', 'name', function ($query, callable $get) {
                            $topic = $get('initiative_topic_id');

                            return $query->where('topic_id', '=', $topic);
                        })
                        ->reactive()
                        ->label('Section')
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            $set('topic_sub_section_id', null);
                        })->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                            else if ($record?->is_published) return true;
                        }),

                    Select::make('topic_sub_section_id')
                        ->searchable()
                        ->preload()
                        ->relationship('topicSubSection', 'name', function ($query, callable $get) {
                            $topicSectionId = $get('topic_section_id');

                            return $query->where('section_id', '=', $topicSectionId);
                        })
                        ->reactive()
                        ->label('Sub Section')
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                            else if ($record?->is_published) return true;
                        }),

//                    Select::make('language_id')
//                        ->relationship('language', 'name', function ($query) {
//                            return $query->orderBy('order_column');
//                        })
//                        ->label('Language')
//                        ->required()
//                        ->selectablePlaceholder(false)
//                        ->default(1),

                    Hidden::make('language_id')->default(1),

                    SpatieTagsInput::make('tags')
                        ->columnSpanFull()
                        ->required()
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                            else if ($record?->is_published) return true;
                        }),

                    SourceInput::make('sources')
                        ->columnSpanFull()
                        ->placeholder('Add sources')
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                            else if ($record?->is_published) return true;
                        }),

                    SourceInput::make('references')
                        ->columnSpanFull()
                        ->placeholder('Add references')
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                            else if ($record?->is_published) return true;
                        }),

                    SpatieMediaLibraryFileUpload::make('pdf')
                        ->label('Upload pdf file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('weekly-focus')
                        ->visibility('private')
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->can('upload_weekly::focus')) return false;
                            else if ($record !== null && $record->hasMedia('weekly-focus')) return false;
                            else return true;
                        })
                        ->openable()
                        ->deletable(function (?PublishedInitiative $record) {
                            if ($record !== null && $record->is_published === true) {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                            } else {
                                return Auth::user()->can('upload_weekly::focus');
                            }
                        })
                        ->columnSpanFull(),

                ])
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
            'index' => Pages\ListWeeklyFocusUploads::route('/'),
            'create' => Pages\CreateWeeklyFocusUpload::route('/create'),
            'edit' => Pages\EditWeeklyFocusUpload::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
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

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_weekly::focus');
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
        return Auth::user()->can('create_weekly::focus');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_weekly::focus') && $record->is_published !== true;
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_weekly::focus');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_weekly::focus') && $record->is_published !== true;
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_weekly::focus');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_weekly::focus');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_weekly::focus');
    }
}
