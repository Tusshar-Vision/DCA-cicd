<?php

namespace App\Traits\Filament;

use App\Filament\Resources\WeeklyFocusResource;
use App\Models\PublishedInitiative;
use App\Traits\HasNotifications;
use App\Traits\NameGenerator;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

trait InitiativeResourceSchema
{
    use HasNotifications, NameGenerator;
    public static function table(Table $table): Table
    {
        $isWeeklyFocus = static::class === WeeklyFocusResource::class;

        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->searchable(),

                TextColumn::make('name')->toggleable()->searchable(),

                IconColumn::make('is_published')
                    ->alignCenter()
                    ->label('Is Published')
                    ->sortable(),

                TextColumn::make('articles_count')
                    ->alignCenter()
                    ->label(function () use($isWeeklyFocus) {
                        return $isWeeklyFocus ? 'Sections' : 'Articles';
                    })
                    ->default(function (Model $record) {
                        return $record->articles->count();
                    })
                    ->badge()
                    ->toggleable(),

                TextColumn::make('short_articles_count')
                    ->alignCenter()
                    ->label('Short Articles')
                    ->default(function (Model $record) {
                        return $record->shortArticles->count();
                    })
                    ->badge()
                    ->hidden(function () use ($isWeeklyFocus) {
                        return $isWeeklyFocus;
                    })
                    ->toggleable(),

                TextColumn::make('progress')
                    ->alignCenter()
                    ->default(function (Model $record) {

                        $totalCountOfArticles = $record->articles->count() + $record->shortArticles->count();

                        if ($totalCountOfArticles === 0) {
                            return "0%";
                        }

                        if ($totalCountOfArticles > 0) {
                            $articleStatus = [];
                            $record->articles->each(function($article) use(&$articleStatus) {
                                if (array_key_exists($article->status, $articleStatus)) {
                                    $articleStatus[$article->status] += 1;
                                } else {
                                    $articleStatus[$article->status] = 1;
                                }
                            });

                            $record->shortArticles->each(function($article) use(&$articleStatus) {
                                if (array_key_exists($article->status, $articleStatus)) {
                                    $articleStatus[$article->status] += 1;
                                } else {
                                    $articleStatus[$article->status] = 1;
                                }
                            });

                            $completedCount = 0;
                            foreach (['Final', 'Published'] as $status) {
                                $completedCount += $articleStatus[$status] ?? 0;
                            }

                            $completePercentage = ($completedCount / $totalCountOfArticles) * 100;

                            return round($completePercentage, 2) . "%";
                        }
                    })
                    ->color(function (string $state) {
                        $completePercentage = intval($state);
                        if ($completePercentage >= 0 && $completePercentage <= 25) {
                            return Color::Red;
                        } elseif ($completePercentage > 25 && $completePercentage <= 50) {
                            return Color::Orange;
                        } elseif ($completePercentage > 50 && $completePercentage <= 75) {
                            return Color::Yellow;
                        } elseif ($completePercentage > 75 && $completePercentage <= 100) {
                            return Color::Green;
                        }
                    })
                    ->badge()
                    ->toggleable(),

                TextColumn::make('published_at')
                    ->dateTime('d M Y')
                    ->label('Publish On')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('publication_date')
                    ->dateTime('M Y')
                    ->label('Issue Month')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Created At')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])->defaultSort('published_at', 'desc')
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Action::make('Publish')
                    ->icon('heroicon-s-paper-airplane')
                    ->requiresConfirmation()
                    ->button()
                    ->visible(function () {
                        return Auth::user()->can('publish_article');
                    })
                    ->hidden(function(Model $record) {
                        $totalArticlesCount = $record->articles->count() + $record->shortArticles->count();
                        if ($totalArticlesCount === 0) return true;

                        $shouldBeHidden = true;

                        $record->articles->each(function($article) use(&$shouldBeHidden) {
                            if ($article->status === 'Final') {
                                $shouldBeHidden = false;
                            }
                        });

                        $record->shortArticles->each(function($article) use(&$shouldBeHidden) {
                            if ($article->status === 'Final') {
                                $shouldBeHidden = false;
                            }
                        });

                        return $shouldBeHidden;
                    })
                    ->action(function (Model $record) {
                        $record->articles->each(function($article) use($record) {

                            if ($article->status === 'Final') {
                                $article->setStatus('Published');
                                $article->update(['published_at' => Carbon::now()]);

                                if ($record->is_published === false) {
                                    $record->is_published = true;
                                    $record->save();
                                }

                                $notification = new self();
                                $notification->sendNotificationOfArticlePublished($article);
                            }
                        });

                        $record->shortArticles->each(function($article) use($record) {

                            if ($article->status === 'Final') {
                                $article->setStatus('Published');
                                $article->update(['published_at' => Carbon::now()]);

                                if ($record->is_published === false) {
                                    $record->is_published = true;
                                    $record->save();
                                }

                                $notification = new self();
                                $notification->sendNotificationOfArticlePublished($article);
                            }
                        });
                    }),
                EditAction::make()
                    ->tooltip('Edit')
                    ->iconButton(),
                DeleteAction::make()
                    ->tooltip('Delete')
                    ->iconButton()
                    ->visible(function (Model $record) {
                        return ($record->articles->count() + $record->shortArticles->count() === 0) && ($record->is_published === false);
                    })
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('Unpublish')
                        ->icon('heroicon-s-x-mark')
                        ->color(Color::Yellow)
                        ->requiresConfirmation()
                        ->modalHeading('Unpublish Initiative?')
                        ->modalDescription('This action would set the published status of the articles inside to improve.')
                        ->visible(function () {
                            return Auth::user()->can('publish_article');
                        })
                        ->action(function (?Collection $records) {
                            $records->each(function ($record) {

                                if ($record->is_published === true) {
                                    $record->is_published = false;
                                    $record->save();
                                }

                                $record->articles->each(function($article) {
                                    if ($article->status === 'Published') {
                                        $article->setStatus('Improve');
                                        $article->featured = false;
                                        $article->update(['published_at' => null]);
                                    }
                                });
                                $record->shortArticles->each(function($article) {
                                    if ($article->status === 'Published') {
                                        $article->setStatus('Improve');
                                        $article->featured = false;
                                        $article->update(['published_at' => null]);
                                    }
                                });
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    ForceDeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            $records->each(function (PublishedInitiative $publishedInitiative) {
                                $publishedInitiative->articles()->withTrashed()->each(function ($record) {
                                    $record->content()->delete();
                                    $record->relatedTerms()->delete();
                                    $record->relatedVideos()->delete();
                                    $record->relatedArticles()->delete();
                                    $record->relatedToArticle()->delete();
                                    $record->bookmarks()->delete();
                                    $record->readHistories()->delete();
                                    $record->forceDelete();
                                });
                                $publishedInitiative->shortArticles()->withTrashed()->each(function ($record) {
                                    $record->content()->delete();
                                    $record->forceDelete();
                                });

                                // Now force delete the PublishedInitiative itself
                                $publishedInitiative->forceDelete();
                            });
                        }),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
