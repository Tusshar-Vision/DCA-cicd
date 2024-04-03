<?php

namespace App\Traits\Filament\Components;

use App\Enums\Initiatives;
use App\Filament\Components\Repeater;
use App\Filament\Components\SourceInput;
use App\Filament\Resources\NewsTodayResource\RelationManagers\ShortArticlesRelationManager;
use App\Filament\Resources\WeeklyFocusResource\RelationManagers\ArticlesRelationManager;
use App\Forms\Components\CKEditor;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as Livewire;
use RalphJSmit\Filament\SEO\SEO;

trait ArticleForm
{
    public function articleForm(Form $form): Form {

        $isShortArticle = static::class === ShortArticlesRelationManager::class || static::class === \App\Filament\Resources\MonthlyMagazineResource\RelationManagers\ShortArticlesRelationManager::class;
        $isWeeklyFocusSection = static::class === ArticlesRelationManager::class;

        return $form
            ->schema([

                Tabs::make('Tabs')->tabs([
                    Tabs\Tab::make('Content')->schema([

                        Section::make('General')->schema([

                            Group::make()->schema([

                                Group::make()->schema([
                                    TextInput::make('title')
                                        ->maxLength(250)
                                        ->required(),
                                    TextInput::make('short_title')
                                        ->maxLength(50)
                                        ->label('Short Title')
                                        ->hidden(function (?Article $record) use ($isShortArticle) {
                                            return $record?->is_short || $isShortArticle;
                                        }),
                                    Textarea::make('excerpt')->label('Description'),
                                ])->columnSpan(1),

                                SpatieMediaLibraryFileUpload::make('featured_image')
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
                                    ->collection('article-featured-image')
                                    ->hidden(function (?Article $record) use ($isShortArticle, $isWeeklyFocusSection) {
                                        return
                                            $isWeeklyFocusSection ||
                                            $isShortArticle ||
                                            $record?->is_short ||
                                            $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS);
                                    }),

                            ])->columns(2),

                            Group::make()->schema([

                                Select::make('author_id')
                                    ->id('expert_id')
                                    ->relationship('author', 'name', function ($query, Livewire $livewire, Article $article) {
                                        $initiative_id = $livewire->ownerRecord?->initiative_id ?? $article->initiative_id;
                                        $roles = collect(['expert']);

                                        if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)) {
                                            $roles->add('news_today_expert');
                                        } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
                                            $roles->add('weekly_focus_expert');
                                        } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE)) {
                                            $roles->add('monthly_magazine_expert');
                                        }

                                        return $query->whereHas('roles', function($subQuery) use($roles) {
                                            return $subQuery->whereIn('name', $roles->toArray());
                                        });
                                    })
                                    ->label('Expert')
                                    ->visible(function () {
                                        return Auth::user()->can('assign_article');
                                    })
                                    ->default(Auth::user()->id)
                                    ->reactive()
                                    ->required(),

                                Hidden::make('author_id')
                                    ->default(function ($get) {
                                        return $get('expert_id');
                                    }),

                                Select::make('reviewer_id')
                                    ->relationship('reviewer', 'name', function ($query, Livewire $livewire, Article $article) {
                                        $initiative_id = $livewire->ownerRecord?->initiative_id ?? $article->initiative_id;
                                        $roles = collect(['reviewer']);

                                        if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)) {
                                            $roles->add('news_today_reviewer');
                                        } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
                                            $roles->add('weekly_focus_reviewer');
                                        } else if ($initiative_id === InitiativesHelper::getInitiativeID(Initiatives::MONTHLY_MAGAZINE)) {
                                            $roles->add('monthly_magazine_reviewer');
                                        }

                                        return $query->whereHas('roles', function($subQuery) use($roles) {
                                            return $subQuery->whereIn('name', $roles->toArray());
                                        });
                                    })
                                    ->visible(function () {
                                        return Auth::user()->can('assign_article');
                                    })
                                    ->label('Reviewer')
                                    ->default(Auth::user()->id)
                                    ->required(),

                            ])->columns(2),

                        ])->columns(1)->collapsible(),

                        Hidden::make('initiative_id')
                            ->default(function(Livewire $livewire) {
                                return $livewire?->ownerRecord?->initiative_id;
                            }),

                        Hidden::make('initiative_topic_id')
                            ->default(function (Livewire $livewire) {
                                return $livewire?->ownerRecord?->initiative_topic_id;
                            })
                            ->disabled(function (?Article $record) use ($isWeeklyFocusSection) {
                                return
                                    !($isWeeklyFocusSection ||
                                        $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS));
                            }),

                        Hidden::make('topic_section_id')
                            ->default(function (Livewire $livewire) {
                                return $livewire?->ownerRecord?->topic_section_id;
                            })
                            ->disabled(function (?Article $record) use ($isWeeklyFocusSection) {
                                return
                                    !($isWeeklyFocusSection ||
                                        $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS));
                            }),

                        Hidden::make('topic_sub_section_id')
                            ->default(function (Livewire $livewire) {
                                return $livewire?->ownerRecord?->topic_sub_section_id;
                            })
                            ->disabled(function (?Article $record) use ($isWeeklyFocusSection) {
                                return
                                    !($isWeeklyFocusSection ||
                                        $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS));
                            }),

                        Section::make('Category')->schema([

                            Group::make()->schema([

                                Select::make('initiative_topic_id')
                                    ->searchable()
                                    ->relationship('topic', 'name', function ($query) {
                                        $query->where('name', '!=', 'All');
                                    })
                                    ->preload()
                                    ->required()
                                    ->label('Subject')
                                    ->default(function (Livewire $livewire) {
                                        return $livewire->ownerRecord->initiative_topic_id;
                                    })
                                    ->reactive()
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        $set('topic_section_id', null);
                                        $set('topic_sub_section_id', null);
                                    }),

                                Select::make('topic_section_id')
                                    ->searchable()
                                    ->relationship('topicSection', 'name', function ($query, callable $get) {
                                        $topic = $get('initiative_topic_id');

                                        return $query->where('topic_id', '=', $topic);
                                    })
                                    ->preload()
                                    ->default(function (Livewire $livewire) {
                                        return $livewire->ownerRecord->topic_section_id;
                                    })
                                    ->reactive()
                                    ->label('Section')
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        $set('topic_sub_section_id', null);
                                    }),

                                Select::make('topic_sub_section_id')
                                    ->searchable()
                                    ->relationship('topicSubSection', 'name', function ($query, callable $get) {
                                        $topicSectionId = $get('topic_section_id');

                                        return $query->where('section_id', '=', $topicSectionId);
                                    })
                                    ->preload()
                                    ->default(function (Livewire $livewire) {
                                        return $livewire->ownerRecord->topic_sub_section_id;
                                    })
                                    ->reactive()
                                    ->label('Sub Section'),

                            ])->columns(1),

                            Group::make()->schema([
                                SpatieTagsInput::make('tags')
                                    ->required(),
                            ])->columns(1)

                        ])
                        ->hidden(function (?Article $record) use ($isWeeklyFocusSection) {
                            return
                                $isWeeklyFocusSection ||
                                $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS);
                        })
                        ->columns(2)
                        ->collapsible(),

                        Hidden::make('is_short')
                            ->default(true)
                            ->disabled(function () use($isShortArticle) {
                                return !$isShortArticle;
                            }),

                        Section::make('Content')
                            ->relationship('content')
                            ->hiddenOn('create')
                            ->schema([
                                CKEditor::make('content')
                                    ->live()
                                    ->afterStateUpdated(function (?string $state, ?string $old, Livewire $livewire) {
                                        if ($livewire->record->status !== 'Published' && $livewire->record->status !== 'Final') {
                                            if ($livewire->record->content()->exists()) {
                                                // If content exists, update it
                                                $livewire->record->content->content = $state; // Assuming 'text' is the attribute where you want to save the content
                                                $livewire->record->content->save();
                                                $livewire->record->touch();
                                            } else {
                                                // If no content exists, create it
                                                $livewire->record->content()->create(['content' => $state]); // Again, assuming 'text' is the correct attribute
                                            }
                                        }
                                }),
                            ])->headerActions([
                                Action::make('Reviews')
                                    ->fillForm(function (Article $record) {
                                        return [
                                            "body" => $record->latestReview()->review ?? 'No reviewer comments available on this article.',
                                        ];
                                    })
                                    ->form([
                                        RichEditor::make('body')
                                            ->label('')
                                            ->disabled()
                                            ->disableToolbarButtons([
                                                'attachFiles',
                                                'codeBlock',
                                            ])
                                            ->maxLength(200)
                                            ->required(),
                                    ])
                                    ->visible(function (?Model $record) {
                                        return $record !== null;
                                    }),

                                Action::make('Changes Incorporated')
                                    ->requiresConfirmation()
                                    ->modalHeading('Are you sure you want to change the status')
                                    ->modalDescription('Make sure you have gone through all the reviews and incorporated them in the article.')
                                    ->visible(function (?Article $record) {
                                        return $record !== null && $record->status === 'Improve';
                                    })
                                    ->action(function(Article $record) {
                                        $record->setStatus('Changes Incorporated');
                                    }),
                            ])->collapsible(),

                        SourceInput::make('sources')
                            ->placeholder('New Source')
                    ]),

                    Tabs\Tab::make('Related Articles')->schema([
                        Repeater::make('articles')
                            ->label('')
                            ->relationship('relatedArticles')
                            ->simple(
                                Select::make('related_article_id')
                                    ->searchable()
                                    ->relationship('relatedArticle', 'title')
                                    ->required()
                            )
                            ->orderColumn('order_column')
                            ->maxItems(4)
                            ->reorderable()
                            ->addActionLabel('Add article')
                    ])->hidden(function (?Article $record) use ($isShortArticle, $isWeeklyFocusSection) {
                        return
                            $isWeeklyFocusSection ||
                            $isShortArticle ||
                            $record?->is_short ||
                            $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS);
                    }),

                    Tabs\Tab::make('Related Videos')->schema([
                        Repeater::make('videos')
                            ->label('')
                            ->relationship('relatedVideos')
                            ->simple(
                                Select::make('video_id')
                                    ->searchable()
                                    ->relationship('video', 'title')
                                    ->required(),
                            )
                            ->orderColumn('order_column')
                            ->maxItems(5)
                            ->reorderable()
                            ->addActionLabel('Add video')
                    ])->hidden(function (?Article $record) use ($isShortArticle, $isWeeklyFocusSection) {
                        return
                            $isWeeklyFocusSection ||
                            $isShortArticle ||
                            $record?->is_short ||
                            $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS);
                    }),

                    Tabs\Tab::make('Related Terms')->schema([
                        Repeater::make('terms')
                            ->label('')
                            ->relationship('relatedTerms')
                            ->simple(
                                Select::make('related_term_id')
                                    ->searchable()
                                    ->relationship('term', 'term')
                                    ->required(),
                            )
                            ->orderColumn('order_column')
                            ->maxItems(3)
                            ->reorderable()
                            ->addActionLabel('Add term')
                    ])->hidden(function (?Article $record) use ($isShortArticle, $isWeeklyFocusSection) {
                        return
                            $isWeeklyFocusSection ||
                            $isShortArticle ||
                            $record?->is_short ||
                            $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS);
                    }),

                    Tabs\Tab::make('SEO')->schema([
                        Section::make('Meta Information')->schema([
                            SEO::make()
                        ])
                    ])->hidden(function (?Article $record) use ($isShortArticle, $isWeeklyFocusSection) {
                        return
                            $isWeeklyFocusSection ||
                            $isShortArticle ||
                            $record?->is_short ||
                            $record?->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS);
                    }),

                ])->columnSpanFull(),
            ]);
    }
}
