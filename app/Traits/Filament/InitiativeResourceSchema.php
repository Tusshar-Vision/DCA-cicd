<?php

namespace App\Traits\Filament;

use App\Services\ArticleService;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

trait InitiativeResourceSchema
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Is Published'),

                TextColumn::make('articles_count')
                    ->label('Articles')
                    ->default(function (Model $record) {
                        return $record->articles->count();
                    })
                    ->badge(),

                TextColumn::make('progress')
                    ->default(function (Model $record) {

                        $totalCountOfArticles = $record->articles->count();

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
                    ->badge(),

                TextColumn::make('published_at')
                    ->dateTime('d M Y')
                    ->label('Publish On')
                    ->sortable(),

            ])->defaultSort('published_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Action::make('Publish')
                    ->icon('heroicon-s-eye')
                    ->button()
                    ->visible(function () {
                        return Auth::user()->hasRole(['admin', 'super_admin']);
                    })
                    ->hidden(function(Model $record) {
                        if ($record->is_published) return true;

                        if ($record->articles->count() === 0) return true;

                        $shouldBeHidden = true;

                        $record->articles->each(function($article) use(&$shouldBeHidden) {
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

                                $articleUrl = ArticleService::getArticleUrlFromSlug($article->slug);
                                $notificationBody = "<a href=\" $articleUrl \" target='_blank'>Click here to check it out</a>";;

                                Notification::make()
                                    ->title('Your article just got published!')
                                    ->body($notificationBody)
                                    ->success()
                                    ->sendToDatabase($article->author);

                                Notification::make()
                                    ->title('Article you reviewed just got published!')
                                    ->body($notificationBody)
                                    ->success()
                                    ->sendToDatabase($article->reviewer);

                            }
                        });
                    }),
                EditAction::make()
                    ->button(),
                DeleteAction::make()
                    ->button()
                    ->visible(function (Model $record) {
                        return $record->articles->count() === 0;
                    })
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('Unpublish')
                        ->icon('heroicon-s-x-mark')
                        ->color(Color::Yellow)
                        ->requiresConfirmation()
                        ->modalDescription('This action would not affect the published status of the articles inside.')
                        ->visible(function () {
                            $user = Auth::user();
                            return $user->hasRole(['admin', 'super_admin']);
                        })
                        ->action(function (?Collection $records) {
                            $records->each(function ($record) {
                                $record->is_published = false;
                                $record->save();
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
