<?php

namespace App\Traits\Filament;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Jobs\GenerateArticlePDF;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use App\Traits\Filament\Components\ArticleForm;
use App\Traits\Filament\Components\ExpertReviewColumn;
use App\Traits\HasNotifications;
use AymanAlhattami\FilamentDateScopesFilter\DateScopeFilter;
use Carbon\Carbon;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as Livewire;
use Spatie\Tags\Tag;

trait ArticleResourceSchema
{
    use ArticleForm, HasNotifications, ExpertReviewColumn;

    public static function form(Form $form): Form
    {
        $articleResource = new self();
        return $articleResource->articleForm($form);
    }

    public static function table(Table $table): Table
    {
        $articleResource = new self();

        return $table
            ->deferLoading()
            ->recordUrl(null)
            ->emptyStateHeading('No Articles')
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->label('id')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    })
                    ->toggleable(),
                IconColumn::make('featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark')
                    ->toggleable(),
                TextColumn::make('initiative.name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('title')
                    ->limit(40)
                    ->tooltip(fn (Model $record): string => $record->title)
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('topic.name')
                    ->label('Subject')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('topicSection.name')
                    ->label('Section')
                    ->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSection->name ?? '')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('topicSubSection.name')
                    ->label('Sub-Section')
                    ->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSubSection->name ?? '')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                SpatieTagsColumn::make('tags')
                    ->toggleable(isToggledHiddenByDefault: true),

                $articleResource->getExpertColumn(Auth::user()->can('assign_article')),
                $articleResource->getReviewColumn(Auth::user()->can('assign_article')),

                TextColumn::make('updated_at')
                    ->label('Last Modified')
                    ->date('d M Y h:i a')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('published_at')
                    ->label('Published At')
                    ->date('d M Y h:i a')
                    ->toggleable(isToggledHiddenByDefault: true)
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
                            ->visible(function (callable $get) {
                                return $get('initiative_topic_id') !== null;
                            })
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
                                fn (Builder $query, $section_id): Builder => $query->where('topic_section_id', '=', $section_id),
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
                    })
                    ->attribute('author_id'),

                SelectFilter::make('Reviewer')
                    ->options(function (User $users) {
                        $experts = $users->whereHas('roles', function($query) {
                            return $query->where('name', 'like', '%reviewer%');
                        })->get();

                        return $experts->pluck('name', 'id');
                    })
                    ->attribute('reviewer_id'),

                SelectFilter::make('Featured')
                    ->options([
                        "1" => 'is Featured',
                        "0" => 'is Not Featured'
                    ])
                    ->attribute('featured'),

                TrashedFilter::make(),
            ], layout: FiltersLayout::AboveContent)->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filters'),
            )
            ->filtersFormColumns(4)
            ->filtersFormMaxHeight('400px')
            ->actions([
               EditAction::make('Edit')
                    ->iconButton()
                    ->tooltip('Edit')
                    ->visible(function (Model $record) {
                        $user = Auth::user();
                        return
                            (
                                $user->can('edit_article') && ($record->status !== 'Published')
                            ) && (
                                $record->reviewer_id === $user->id || ($record->author_id === $user->id && $record->status !== 'Final') || $user->hasRole(['admin', 'super_admin'])
                            );
                    }),

                Action::make('View')
                    ->visible(function (Article $record) {
                        if ($record->status === 'Published') return true;

                        $user = Auth::user();

                        if ($record->reviewer_id === $user->id) return false;

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
                    ->iconButton()
                    ->tooltip('View')
                    ->fillForm(fn (Article $record): array => [
                        'title' => $record->title,
                        'subject' => $record->topic->name,
                        'section' => $record->topicSection->name ?? '',
                        'subSection' => $record->topicSubSection->name ?? '',
                        'author' => $record->author->name,
                        'reviewer' => $record->reviewer->name ?? '',
                        'tags' => $record->tags,
                        'body' => $record->latestReview()->review ?? 'No reviewer comments available on this article.',
                        'content' => $record->content->content,
                        'sources' => $record->sources
                    ])
                    ->form([
                        TextInput::make('title')->disabled(),
                        Group::make()->schema([
                            TextInput::make('subject')->disabled(),
                            TextInput::make('section')->disabled(),
                            TextInput::make('subSection')->disabled(),
                        ])->columns(3),
                        SpatieTagsInput::make('tags')->placeholder('')->disabled(),
                        Group::make()->schema([
                            TextInput::make('author')->disabled(),
                            TextInput::make('reviewer')->disabled(),
                        ])->columns(),
                        TinyEditor::make('content')
                            ->columnSpanFull()
                            ->profile('review')
                            ->maxHeight(500),

                        RichEditor::make('body')
                            ->label('Review Comments')
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                            ])->disabled(),

                        TagsInput::make('sources')->placeholder('')->disabled()
                    ])->slideOver(),

                Action::make('Review')
                    ->tooltip('Review')
                    ->icon('heroicon-s-chat-bubble-left-right')
                    ->visible(function (Article $record) {
                        $user = Auth::user();
                        return
                            (
                                $user->can('review_article') &&
                                $record->reviewer_id === $user->id &&
                                $record->status !== 'Published'
                            ) || (
                                $user->can('review_article') &&
                                $user->hasRole(['super_admin', 'admin']) &&
                                $record->status !== 'Published'
                            );
                    })
                    ->fillForm(fn (Article $record): array => [
                        'title' => $record->title,
                        'subject' => $record->topic->name,
                        'section' => $record->topicSection->name ?? '',
                        'subSection' => $record->topicSubSection->name ?? '',
                        'tags' => $record->tags,
                        'status' => $record->status,
                        'body' => $record->latestReview()->review ?? '',
                    ])
                    ->form([
                        TextInput::make('title')->disabled(),
                        Group::make()->schema([
                            TextInput::make('subject')->disabled(),
                            TextInput::make('section')->disabled(),
                            TextInput::make('subSection')->disabled(),
                        ])->columns(3),
                        SpatieTagsInput::make('tags')->placeholder('')->disabled(),
                        Section::make('Article Content')
                            ->relationship('content')
                            ->schema([
                                TinyEditor::make('content')
                                    ->columnSpanFull()
                                    ->profile('review')
                                    ->maxHeight(500)
                                    ->hiddenLabel(),
                        ])->collapsible(),

                        Section::make('Review Comment')->schema([
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
                                ->placeholder('Add your comments...')
                                ->label('')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                    'codeBlock',
                                ]),
                        ])
                    ])->slideOver()
                    ->action(function (array $data, Model $record) {
                        $author = Auth::user();

                        if($record->hasReview())
                            $record->latestReview()->update(['review' => $data['body']]);
                        else
                            ($data['body'] !== null) ? $record->review($data['body'], $author, 0) : null;

                        $record->setStatus($data['status']);
                    })->iconButton(),

                DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Delete')
                    ->visible(function (Article $record) {
                        return $record->status === 'Reject' || $record->status === 'Draft';
                    })
                    ->action(function (Article $record) {
                        $record->delete();
                    }),

            ], ActionsPosition::BeforeColumns)
            ->bulkActions([
                BulkActionGroup::make([

                    BulkAction::make('Publish Articles')
                        ->icon('heroicon-s-check')
                        ->color(Color::Green)
                        ->requiresConfirmation()
                        ->modalDescription('Only the articles that have a status of final will be published.')
                        ->visible(function () {
                            return Auth::user()->can('publish_article');
                        })
                        ->action(function (?Collection $records) {
                            $records->each(function ($record) {
                                if ($record->status === 'Final') {
                                    $record->setStatus('Published');
                                    $record->update(['published_at' => Carbon::now()]);

                                    if ($record->publishedInitiative->is_published === false) {
                                        $record->publishedInitiative->is_published = true;
                                        $record->publishedInitiative->save();
                                    }
                                }
                                $articleResource = new self();
                                $articleResource->sendNotificationOfArticlePublished($record);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('Unpublish Articles')
                        ->icon('heroicon-s-x-mark')
                        ->color(Color::Yellow)
                        ->requiresConfirmation()
                        ->modalDescription('Only the articles that have a status of published will be unpublished.')
                        ->visible(function () {
                            return Auth::user()->can('publish_article');
                        })
                        ->action(function (?Collection $records) {
                            $records->each(function ($record) {
                                if ($record->status === 'Published') {
                                    $record->setStatus('Improve');
                                    $record->featured = false;
                                    $record->save();
                                }
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('Set Featured')
                        ->color(Color::hex('#00569e'))
                        ->icon('heroicon-s-star')
                        ->requiresConfirmation()
                        ->modalDescription('Only the articles that have a status of published will be featured.')
                        ->visible(function () {
                            return Auth::user()->can('publish_article');
                        })
                        ->action(function (Collection $records) {
                            $records->each(function($article) {
                                if ($article->status === 'Published') {
                                    $article->featured = true;
                                    $article->save();
                                }
                            });
                        })->deselectRecordsAfterCompletion(),

                    BulkAction::make('Unset Featured')
                        ->color(Color::Red)
                        ->icon('heroicon-s-x-mark')
                        ->visible(function () {
                            return Auth::user()->can('publish_article');
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

                    ForceDeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            $records->each(function (Article $record) {
                                $record->content()->delete();
                                $record->relatedTerms()->delete();
                                $record->relatedVideos()->delete();
                                $record->relatedArticles()->delete();
                                $record->relatedToArticle()->delete();
                                $record->bookmarks()->delete();
                                $record->readHistories()->delete();
                                $record->forceDelete();
                            });
                        }),
                    RestoreBulkAction::make(),
                ])
            ]);
    }
}
