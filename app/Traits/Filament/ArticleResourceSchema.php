<?php

namespace App\Traits\Filament;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Jobs\GenerateArticlePDF;
use App\Models\User;
use App\Services\ArticleService;
use App\Traits\Filament\Components\ArticleForm;
use AymanAlhattami\FilamentDateScopesFilter\DateScopeFilter;
use Carbon\Carbon;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
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
use Spatie\Tags\Tag;

trait ArticleResourceSchema
{
    use ArticleForm;
    public static function form(Form $form): Form
    {
        $articleResource = new self();
        return $articleResource->articleForm($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->label('id'),
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
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
                TextColumn::make('initiative.name')
                    ->searchable(),
                TextColumn::make('title')
                    ->limit(40)
                    ->tooltip(fn (Model $record): string => $record->title)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('topic.name')
                    ->label('Subject')
                    ->searchable(),
                TextColumn::make('topicSection.name')
                    ->label('Section')
                    ->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSection->name ?? '')
                    ->searchable(),
                TextColumn::make('topicSubSection.name')
                    ->label('Sub-Section')
                    ->limit(20)
                    ->tooltip(fn (Model $record): string => $record->topicSubSection->name ?? '')
                    ->searchable(),
                SpatieTagsColumn::make('tags'),
                TextColumn::make('author.name')
                    ->searchable()
                    ->label('Expert'),
                TextColumn::make('reviewer.name')
                    ->searchable()
                    ->label('Reviewer'),
                TextColumn::make('updated_at')
                    ->label('Last Modified')
                    ->date('d M Y h:i a')
                    ->sortable(),
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
                    ->attribute('featured')

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
                    ->button()
                    ->fillForm(fn (Model $record): array => [
                        'content' => $record->content,
                    ])
                    ->form([
                        TinyEditor::make('content')
                            ->columnSpanFull()
                            ->profile('review')
                            ->maxHeight(500)
                            ->hiddenLabel(),
                    ])->slideOver(),

                EditAction::make()
                    ->button()
                    ->visible(function (Model $record) {
                        $user = Auth::user();
                        if ($record->status === 'Published') return false;
                        if($user->hasRole(['super_admin', 'admin'])) return true;
                        return $user->can('update_article') && $record->author_id == $user->id && $record->status !== 'Final';
                    }),

                Action::make('Review')
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
                        Section::make('Article Content')->schema([
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
                                    $record->update(['published_at' => Carbon::now()]);
                                }

                                $articleUrl = ArticleService::getArticleUrlFromSlug($record->slug);
                                $notificationBody = "<a href=\" $articleUrl \" target='_blank'>Click here to check it out</a>";;

                                Notification::make()
                                    ->title('Your article just got published!')
                                    ->body($notificationBody)
                                    ->success()
                                    ->sendToDatabase($record->author);

                                Notification::make()
                                    ->title('Article you reviewed just got published!')
                                    ->body($notificationBody)
                                    ->success()
                                    ->sendToDatabase($record->reviewer);
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
}