<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Enums\InitiativeTopics;
use App\Filament\Resources\WeeklyFocusResource\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\WeeklyFocusResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\InitiativeTopic;
use App\Models\PublishedInitiative;
use App\Models\TopicSection;
use App\Models\TopicSubSection;
use App\Models\Video;
use App\Services\MediaService;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\InitiativeResourceSchema;
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
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as Livewire;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
                Forms\Components\Section::make('General')->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)),

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
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state !== null)
                                    $set('name', static::generateName($state));
                                }),

                        Forms\Components\TextInput::make('name')->default(function (callable $get) {
                            return static::generateName($get('published_at'));
                        })
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
                            ->required(),

                    ])->columns(2)->columnSpanFull(),

                    Select::make('initiative_topic_id')
                        ->relationship('topic', 'name')
                        ->required()
                        ->label('Subject')
                        ->reactive()
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            $set('topic_section_id', null);
                            $set('topic_sub_section_id', null);
                        }),

                    Select::make('topic_section_id')
                        ->relationship('topicSection', 'name', function ($query, callable $get) {
                            $topic = $get('initiative_topic_id');

                            return $query->where('topic_id', '=', $topic);
                        })
                        ->reactive()
                        ->label('Section')
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            $set('topic_sub_section_id', null);
                        }),

                    Select::make('topic_sub_section_id')
                        ->relationship('topicSubSection', 'name', function ($query, callable $get) {
                            $topicSectionId = $get('topic_section_id');

                            return $query->where('section_id', '=', $topicSectionId);
                        })
                        ->reactive()
                        ->label('Sub Section'),

                    Select::make('language_id')
                        ->relationship('language', 'name', function ($query) {
                            return $query->orderBy('order_column');
                        })
                        ->label('Language')
                        ->required()
                        ->default(1),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('pdf')
                        ->label('Upload pdf file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('weekly-focus')
                        ->visibility('private')
                        ->visible(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'weekly_focus_reviewer'])) return true;
                            else if ($record !== null && $record->hasMedia('weekly-focus')) return true;
                            else return false;
                        })
                        ->openable()
                        ->deletable(function (?PublishedInitiative $record) {
                            if ($record !== null && $record->is_published === true) {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                            } else {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin', 'reviewer', 'weekly_focus_reviewer']);
                            }
                        })
                        ->columnSpanFull(),

                ])
                ->columnSpan(1)
                ->disabled(function (?PublishedInitiative $record) {
                    if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                    else if ($record->is_published) return true;
                })
                ->columns(),

                Group::make()->schema([
                    Forms\Components\Section::make('Topic at a glance')
                        ->schema([
                            Select::make('infographic_id')
                                ->hiddenLabel()
                                ->searchable()
                                ->relationship('infographic', 'title')
                                ->createOptionForm([
                                    TextInput::make('title')->required(),
                                    SpatieTagsInput::make('tags')
                                        ->required(),

                                    Hidden::make('initiative_topic_id')
                                        ->default(function (Livewire $livewire) {
                                            return $livewire->getRecord()?->getAttribute('initiative_topic_id');
                                        })
                                        ->required(),

                                    Hidden::make('topic_section_id')
                                        ->default(function (Livewire $livewire) {
                                            return $livewire->getRecord()?->getAttribute('topic_section_id');
                                        }),

                                    Hidden::make('topic_sub_section_id')
                                        ->default(function (Livewire $livewire) {
                                            return $livewire->getRecord()?->getAttribute('topic_sub_section_id');
                                        }),

                                    Hidden::make('language_id')
                                        ->required()
                                        ->default(function (Livewire $livewire) {
                                            return $livewire->getRecord()?->getAttribute('language_id');
                                        }),

                                    Hidden::make('author_id')->default(function () {
                                        return Auth::user()->id;
                                    }),

                                    SpatieMediaLibraryFileUpload::make('Infographic')
                                        ->id('infographic')
                                        ->collection('infographic')
                                        ->required()
                                        ->acceptedFileTypes([
                                            'application/pdf',
                                            'image/jpeg',
                                            'image/png',
                                            'image/svg'
                                        ]),
                                ])
                                ->disabledOn('create')
                                ->disabled(function () {
                                    if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'weekly_focus_reviewer'])) return false;
                                    else return true;
                                }),
                        ])->columnSpan(1),

                    Forms\Components\Section::make("In Conversation")
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
                                            ->default(function (Livewire $livewire) {
                                                return $livewire->getRecord()?->getAttribute('initiative_topic_id');
                                            })
                                            ->required(),

                                        Hidden::make('topic_section_id')
                                            ->default(function (Livewire $livewire) {
                                                return $livewire->getRecord()?->getAttribute('topic_section_id');
                                            }),

                                        Hidden::make('topic_sub_section_id')
                                            ->default(function (Livewire $livewire) {
                                                return $livewire->getRecord()?->getAttribute('topic_sub_section_id');
                                            }),

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
                                                if ($record !== null && $record->is_published === true) {
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

                                        Hidden::make('language_id')
                                            ->required()
                                            ->default(function (Livewire $livewire) {
                                                return $livewire->record->language_id;
                                            }),

                                        Hidden::make('author_id')->default(function () {
                                            return Auth::user()->id;
                                        })

                                    ])->columnSpan(1)
                                ])
                                ->disabledOn('create')
                                ->disabled(function () {
                                    if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'weekly_focus_reviewer'])) return false;
                                    else return true;
                                }),
                        ])->columnSpan(1)
                ])
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
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
            ->with('articles')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

}
