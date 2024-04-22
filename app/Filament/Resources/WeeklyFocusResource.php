<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Enums\InitiativeTopics;
use App\Filament\Components\SourceInput;
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

class WeeklyFocusResource extends Resource implements HasShieldPermissions
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
                Section::make('General')->schema([

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
                            ->suffixAction(Forms\Components\Actions\Action::make('Generate')
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

                    Forms\Components\SpatieMediaLibraryFileUpload::make('pdf')
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
                ->columnSpan(1)
                ->columns(),

                Group::make()->schema([
                    Section::make('Featured Image')->schema([
                        SpatieMediaLibraryFileUpload::make('featured_image')
                            ->hiddenLabel()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/svg',
                                'image/webp'
                            ])
                            ->disk('s3_public')
                            ->collection('article-featured-image'),
                    ])->disabled(function ($operation) {
                            if (Auth::user()->can('upload_weekly::focus')) return false;
                            else return true;
                        }),
                    Section::make('Topic at a glance')
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
                                            'image/jpeg',
                                            'image/png',
                                            'image/svg'
                                        ]),
                                ])
                                ->disabled(function ($operation) {
                                    if ($operation === 'create') return true;
                                    if (Auth::user()->can('upload_weekly::focus')) return false;
                                    else return true;
                                }),
                        ])->columnSpan(1),

                    Section::make("In Conversation")
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
                                ->disabled(function ($operation) {
                                    if ($operation === 'create') return true;
                                    if (Auth::user()->can('upload_weekly::focus')) return false;
                                    else return true;
                                }),
                        ])->columnSpan(1),
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

}
