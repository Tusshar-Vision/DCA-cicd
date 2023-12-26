<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ArticleResource\Pages;
use App\Jobs\GenerateArticlePDF;
use App\Models\Article;
use App\Models\User;
use AymanAlhattami\FilamentDateScopesFilter\DateScopeFilter;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use RalphJSmit\Filament\SEO\SEO;
use Spatie\Tags\Tag;

class ArticleResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'All Article';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Tabs')->tabs([

                    Tabs\Tab::make('Content')->schema([

                        Section::make('General')->schema([

                            Group::make()->schema([
                                Group::make()->schema([
                                    TextInput::make('title')->required(),
                                    Textarea::make('excerpt')->rows(6)->label('Description'),
                                ])->columnSpan(1),

                                SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->collection('article_featured_image')
                                    ->responsiveImages()
                                    ->conversion('thumb'),
                            ])->columns(2),


                            Group::make()->schema([

                                Select::make('author_id')
                                    ->id('expert_id')
                                    ->relationship('author', 'name', function ($query) {
                                        return $query->whereHas('roles', function($subQuery) {
                                            return $subQuery->whereIn('name', ['expert', 'news_today_expert']);
                                        });
                                    })
                                    ->label('Expert')
                                    ->visible(function () {
                                        return Auth::user()->hasRole(['admin', 'super_admin']);
                                    })
                                    ->default(Auth::user()->id)
                                    ->reactive()
                                    ->required(),

                                Hidden::make('author_id')->default(function ($get) {
                                    return $get('expert_id');
                                }),

                                Select::make('reviewer_id')
                                    ->relationship('reviewer', 'name', function ($query) {
                                        return $query->whereHas('roles', function($subQuery) {
                                            return $subQuery->whereIn('name', ['reviewer', 'news_today_reviewer']);
                                        });
                                    })
                                    ->visible(function () {
                                        return Auth::user()->hasRole(['admin', 'super_admin']);
                                    })
                                    ->label('Reviewer')
                                    ->default(Auth::user()->id)
                                    ->required(),

                            ])->columns(2),

                        ])->columns(1)->collapsible(),

                        Section::make('Category')->schema([

                            Group::make()->schema([
                                Select::make('initiative_topic_id')
                                    ->relationship('topic', 'name')
                                    ->required()->label('Subject')
                                    ->reactive(),

                                Select::make('topic_section_id')
                                    ->relationship('topicSection', 'name', function ($query, callable $get) {
                                        $topic = $get('initiative_topic_id');

                                        return $query->where('topic_id', '=', $topic);
                                    })->reactive()
                                    ->label('Section'),

                                Select::make('topic_sub_section_id')
                                    ->relationship('topicSubSection', 'name', function ($query, callable $get) {
                                        $topicSectionId = $get('topic_section_id');

                                        return $query->where('section_id', '=', $topicSectionId);
                                    })->reactive()
                                    ->label('Sub Section'),
                            ])->columns(1),

                            Group::make()->schema([

                                Select::make('language')->options([
                                    "english" => "English",
                                    "hindi" => "Hindi",
                                ])->required()->default('english'),

                                SpatieTagsInput::make('tags')->required(),

                            ])->columns(1)

                        ])->columns(2)->collapsible(),

                        Section::make('Content')->schema([

                            TinyEditor::make('content')
                                ->columnSpanFull()
                                ->profile('full')
                                ->toolbarSticky(true)
                                ->maxHeight(500)
                                ->hiddenLabel(),
                            TagsInput::make('sources')->separator(',')->placeholder('New Source')

                        ])->headerActions([
                            \Filament\Forms\Components\Actions\Action::make('Reviews')
                                ->fillForm(function (Model $record) {
                                    return [
                                        "body" => $record->latestReview()->review ?? '',
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
                                })
                            ,

                            \Filament\Forms\Components\Actions\Action::make('Changes Incorporated')
                                ->requiresConfirmation()
                                ->modalHeading('Are you sure you want to change the status')
                                ->modalDescription('Make sure you have gone through all the reviews and incorporated them in the article.')
                                ->visible(function (?Model $record) {
                                    return $record !== null && $record->status === 'Improve';
                                })
                                ->action(function(Model $record) {
                                    $record->setStatus('Changes Incorporated');
                                }),
                        ])->collapsible(),

                    ]),

                    Tabs\Tab::make('SEO')->schema([
                        Section::make('Meta Information')->schema([
                            SEO::make()
                        ])
                    ]),

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('id')->label('id'),
                TextColumn::make('article.status')
                    ->label('Status')
                    ->default(function (Model $record) {
                        return mb_substr($record->status, 0, 1);
                    })
                    ->tooltip(function (Model $record) {
                        return $record->status;
                    })
                    ->badge()
                    ->color(function (Model $record) {
                        switch ($record->status) {
                            case 'Draft': return Color::Gray;
                            case 'Improve': return Color::Yellow;
                            case 'Changes Incorporated': return Color::Blue;
                            case 'Reject': return Color::Red;
                            case 'Final': return Color::Orange;
                            case 'Published': return Color::Green;
                            case 'Final Database': return Color::Indigo;
                        }
                    }),
                IconColumn::make('featured')
                    ->boolean()->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
                TextColumn::make('initiative.name')
                    ->searchable(),
                TextColumn::make('title')->limit(40)
                    ->tooltip(fn (Model $record): string => $record->title)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('topic.name')->label('Subject')
                    ->searchable(),
                TextColumn::make('topicSection.name')->label('Section')->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSection->name ?? '')
                    ->searchable(),
                TextColumn::make('topicSubSection.name')->label('Sub-Section')->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSubSection->name ?? '')
                    ->searchable(),
                SpatieTagsColumn::make('tags'),
                TextColumn::make('author.name')->label('Expert'),
                TextColumn::make('reviewer.name')->label('Reviewer'),
                TextColumn::make('updated_at')->label('Last Modified')->date('d M Y h:m a')->sortable(),
            ])
            ->filters([
                DateScopeFilter::make('created_at'),

                Filter::make('Status')
                    ->form([
                        Select::make('status')->options([
                            "Draft" => "Draft",
                            "Improve" => "Improve",
                            "Changes Incorporated" => "Changes Incorporated",
                            "Reject" => "Reject",
                            "Final" => "Final",
                            "Published" => "Published",
                            "Final Database" => "Final Database"
                        ]),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['status'],
                                fn (Builder $query, $status) => $query->currentStatus($status),
                            );
                    }),

                SelectFilter::make('Initiative')->options([
                    1 => 'News Today',
                    2 => 'Monthly Magazine',
                    3 => 'Weekly Focus'
                ])->attribute('initiative_id'),

                Filter::make('Section')
                    ->form([
                        Select::make('initiative_topic_id')
                            ->relationship('topic', 'name')
                            ->reactive()
                            ->label('Subject'),
                        Select::make('topic_section_id')
                            ->relationship('topicSection', 'name', function ($query, callable $get) {
                                $topic = $get('initiative_topic_id');

                                return $query->where('topic_id', '=', $topic);
                            })
                            ->label('Section'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['initiative_topic_id'],
                                fn (Builder $query, $topic_id): Builder => $query->where('initiative_topic_id', '=', $topic_id),
                            )
                            ->when(
                                $data['topic_section_id'],
                                fn (Builder $query, $section_id): Builder => $query->whereDate('topic_section_id', '=', $section_id),
                            );
                    }),

                SelectFilter::make('tags')
                    ->multiple()
                    ->options(Tag::all()->pluck('name', 'name'))
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['values'], function (Builder $query, $data): Builder {
                            return $query->withAnyTags(array_values($data));
                        });
                    }),

                SelectFilter::make('Expert')
                    ->options(function (User $users) {
                        $experts = $users->whereHas('roles', function($query) {
                            return $query->where('name', 'like', '%expert%');
                        })->get();

                        return $experts->pluck('name', 'id');
                    })->attribute('author_id'),

                SelectFilter::make('Reviewer')
                    ->options(function (User $users) {
                        $experts = $users->whereHas('roles', function($query) {
                            return $query->where('name', 'like', '%reviewer%');
                        })->get();

                        return $experts->pluck('name', 'id');
                    })->attribute('reviewer_id'),

                SelectFilter::make('Featured')
                    ->options([
                        "1" => 'is Featured',
                        "0" => 'is Not Featured'
                    ])->attribute('featured')

            ], layout: FiltersLayout::AboveContent)->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filters'),
            )
            ->filtersFormColumns(4)
            ->filtersFormMaxHeight('400px')
            ->actions([

                Action::make('View')
                    ->visible(function (Model $record) {
                        $user = Auth::user();

                        if ($record->status === 'Published') return true;

                        if ($user->hasRole(['super_admin', 'admin'])) return false;

                        if ($user->cant('update_article')) {
                            if ($user->cant('review_article')) {
                                return true;
                            }
                        }

                        if ($record->author_id !== $user->id) {
                            return true;
                        }
                    })
                    ->icon('heroicon-s-eye')
                    ->button()
                    ->fillForm(fn (Model $record): array => [
                        'content' => $record->content,
                    ])
                    ->form([
                        TinyEditor::make('content')
                            ->columnSpanFull()
                            ->maxHeight(500)
                            ->hiddenLabel(),
                    ]),

                EditAction::make()
                    ->button()
                    ->visible(function (Model $record) {
                        $user = Auth::user();
                        if ($record->status === 'Published') return false;
                        if($user->hasRole(['super_admin', 'admin'])) return true;
                        return $user->can('update_article') && $record->author_id == $user->id && $record->status !== 'Final';
                    }),

                Action::make('review')
                    ->icon('heroicon-s-chat-bubble-left-right')
                    ->visible(function (Model $record) {
                        $user = Auth::user();
                        if ($record->status === 'Published') return false;
                        if($user->hasRole(['super_admin', 'admin'])) return true;
                        return $user->can('review_article') && $record->reviewer_id == $user->id;
                    })
                    ->fillForm(function (Model $record) {
                        return [
                            "body" => $record->latestReview()->review ?? '',
                            "status" => $record->status,
                            'content' => $record->content,
                        ];
                    })
                    ->form([
                        TinyEditor::make('content')
                            ->columnSpanFull()
                            ->maxHeight(500)
                            ->hiddenLabel(),

                        Select::make('status')->options([
                            "Draft" => "Draft",

                            'In Process' => [
                                "Improve" => "Improve",
                                "Changes Incorporated" => "Changes Incorporated",
                            ],
                            'Reviewed' => [
                                "Reject" => "Reject",
                                "Final" => "Final",
                            ]
                        ])->default(function(?Model $record) {
                            return $record->status;
                        })->required()
                            ->disableOptionWhen(fn (string $value): bool => $value === 'Changes Incorporated' || $value === 'Draft'),

                        RichEditor::make('body')
                            ->label('')
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                            ]),
                    ])
                    ->action(function (array $data, Model $record) {
                        $author = Auth::user();

                        if($record->hasReview())
                            $record->latestReview()->update(['review' => $data['body']]);
                        else
                            ($data['body'] !== null) ? $record->review($data['body'], $author, 0) : null;

                        $record->setStatus($data['status']);
                    })->button()

            ], ActionsPosition::BeforeColumns)
            ->bulkActions([
                BulkActionGroup::make([

                    BulkAction::make('Publish Articles')
                        ->icon('heroicon-s-check')
                        ->color(Color::Green)
                        ->requiresConfirmation()
                        ->modalDescription('Only the articles that have a status of final will be published.')
                        ->visible(function () {
                            $user = Auth::user();
                            return $user->hasRole(['admin', 'super_admin']);
                        })
                        ->action(function (?Collection $records) {
                            $records->each(function ($record) {
                                if ($record->status === 'Final') {
                                    $record->setStatus('Published');
                                }
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('Unpublish Articles')
                        ->icon('heroicon-s-x-mark')
                        ->color(Color::Yellow)
                        ->requiresConfirmation()
                        ->modalDescription('Only the articles that have a status of published will be unpublished.')
                        ->visible(function () {
                            $user = Auth::user();
                            return $user->hasRole(['admin', 'super_admin']);
                        })
                        ->action(function (?Collection $records) {
                            $records->each(function ($record) {
                                if ($record->status === 'Published') {
                                    $record->setStatus('Improve');
                                }
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('Set Featured')
                        ->color(Color::hex('#00569e'))
                        ->icon('heroicon-s-star')
                        ->visible(function () {
                            $user = Auth::user();
                            return $user->hasRole(['admin', 'super_admin']);
                        })
                        ->action(function (Collection $records) {
                            $records->each(function($article) {
                                $article->featured = true;
                                $article->save();
                            });
                        })->deselectRecordsAfterCompletion(),

                    BulkAction::make('Unset Featured')
                        ->color(Color::Red)
                        ->icon('heroicon-s-x-mark')
                        ->visible(function () {
                            $user = Auth::user();
                            return $user->hasRole(['admin', 'super_admin']);
                        })
                        ->action(function (Collection $records) {
                            $records->each(function($article) {
                                $article->featured = false;
                                $article->save();
                            });
                        })->deselectRecordsAfterCompletion(),

                    BulkAction::make('Export as pdf File')
                        ->icon('heroicon-s-arrow-top-right-on-square')
                        ->requiresConfirmation()
                        ->color(Color::hex('#00569e'))
                        ->action(function (Collection $records) {
                            $user = Auth::user();
                            GenerateArticlePDF::dispatch($records, $user);

                            Notification::make()
                                ->title('Export has been started!')
                                ->body('You will get a notification when your files are ready to download')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    DeleteBulkAction::make()
                ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'review'
        ];
    }
}
