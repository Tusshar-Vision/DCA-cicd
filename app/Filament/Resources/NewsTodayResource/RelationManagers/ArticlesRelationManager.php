<?php

namespace App\Filament\Resources\NewsTodayResource\RelationManagers;

use App\Models\Article;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Spatie\Tags\Tag;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')->required()->columnSpanFull(),

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

                    TinyEditor::make('content')->columnSpanFull(),
                ])->columnSpan(2),

                Section::make('meta')->schema([
                    Select::make('author_id')
                        ->relationship('author', 'name', function ($query) {
                            return $query->whereHas('roles', function($subQuery) {
                                return $subQuery->whereIn('name', ['Admin', 'Expert']);
                            });
                        })
                        ->label('Expert')
                        ->default(Auth::user()->id)
                        ->required(),

                    Select::make('reviewer_id')
                        ->relationship('reviewer', 'name', function ($query) {
                            return $query->whereHas('roles', function($subQuery) {
                                return $subQuery->whereIn('name', ['Admin', 'Reviewer']);
                            });
                        })
                        ->label('Reviewer')
                        ->default(Auth::user()->id)
                        ->required(),

                    Toggle::make('featured'),

                    FileUpload::make('featured_image'),

                    Select::make('language')->options([
                        "hindi" => "Hindi",
                        "english" => "English",
                    ])->required()->default('english'),

                    SpatieTagsInput::make('tags')->required(),
                    TagsInput::make('sources')->separator(','),
                    Textarea::make('excerpt'),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('id')->label('id'),
                TextColumn::make('title')->limit(40)
                    ->tooltip(fn (Article $article): string => $article->title),
                TextColumn::make('initiative.name'),
                IconColumn::make('featured')
                    ->boolean()->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
                TextColumn::make('topic.name')->label('Subject'),
                TextColumn::make('topicSection.name')->label('Section'),
                TextColumn::make('topicSubSection.name')->label('Sub-Section'),
                Tables\Columns\SpatieTagsColumn::make('tags'),
                TextColumn::make('author.name')->label('Expert'),
                TextColumn::make('reviewer.name')->label('Reviewer'),
            ])
            ->filters([
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
                            return $query->whereIn('name', ['Admin', 'Expert']);
                        })->get();

                        return $experts->pluck('name', 'id');
                    })->attribute('author_id'),

                SelectFilter::make('Reviewer')
                    ->options(function (User $users) {
                        $experts = $users->whereHas('roles', function($query) {
                            return $query->whereIn('name', ['Admin', 'Reviewer']);
                        })->get();

                        return $experts->pluck('name', 'id');
                    })->attribute('reviewer_id'),
            ], layout: FiltersLayout::AboveContentCollapsible)->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filters'),
            )
            ->filtersFormColumns(4)
            ->filtersFormMaxHeight('400px')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
