<?php

namespace App\Traits\Filament;

use App\Enums\Initiatives;
use App\Helpers\InitiativesHelper;
use App\Jobs\GenerateArticlePDF;
use App\Models\Article;
use App\Models\User;
use App\Traits\Filament\Components\ArticleForm;
use App\Traits\Filament\Components\ExpertReviewColumn;
use App\Traits\Filament\Components\ReviewAction;
use App\Traits\Filament\Components\StatusColumn;
use App\Traits\Filament\Components\ViewAction;
use App\Traits\HasNotifications;
use AymanAlhattami\FilamentDateScopesFilter\DateScopeFilter;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
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
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Spatie\Tags\Tag;

trait ArticleResourceSchema
{
    use ArticleForm, HasNotifications, ExpertReviewColumn, StatusColumn, ViewAction, ReviewAction;

    public static function form(Form $form): Form
    {
        $articleResource = new self();
        return $articleResource->articleForm($form);
    }

    /**
     * @throws \Exception
     */
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
                $articleResource->getStatusColumn(Auth::user()->can('review_article')),
                IconColumn::make('featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark')
                    ->alignCenter()
                    ->toggleable(),
                TextColumn::make('initiative.name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->alignCenter()
                    ->default(function (Model $record) {
                        if ($record->is_short) {
                            return 'Short';
                        } else {
                            if ($record->initiative_id === InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)) {
                                return 'Section';
                            }
                            return 'Full';
                        }
                    })
                    ->color(function (Model $record) {
                        switch ($record->is_short) {
                            case true: return Color::Gray;
                            case false: return Color::Blue;
                        }
                    })->toggleable(isToggledHiddenByDefault: false),
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
                DateRangeFilter::make('created_at')->linkedCalendars(false),

                Filter::make('Status')
                    ->form([
                        Select::make('status')->options([
                            "Draft" => "Draft",
                            "Improve" => "Improve",
                            "Changes Incorporated" => "Changes Incorporated",
                            "Reject" => "Reject",
                            "Final" => "Final",
                            "Published" => "Published",
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
                    ->tooltip('Edit'),

                $articleResource->viewAction(),
                $articleResource->reviewAction(),

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
