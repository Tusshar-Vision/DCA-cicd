<?php

namespace App\Traits\Filament;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Jobs\GenerateArticlePDF;
use App\Livewire\Review\CreateReview;
use App\Livewire\Review\ListReviews;
use App\Models\User;
use AymanAlhattami\FilamentDateScopesFilter\DateScopeFilter;
use Carbon\Carbon;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Livewire;
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
use Filament\Resources\Components\Tab;
use Filament\Support\Colors\Color;
use Filament\Support\Colors\ColorManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\ModelStatus\Status;
use Spatie\Tags\Tag;

trait HasArticles
{
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
                                    ->relationship('author', 'name', function ($query) {
                                        return $query->whereHas('roles', function($subQuery) {
                                            return $subQuery->whereIn('name', ['expert']);
                                        });
                                    })
                                    ->label('Expert')
                                    ->default(Auth::user()->id)
                                    ->required(),

                                Select::make('reviewer_id')
                                    ->relationship('reviewer', 'name', function ($query) {
                                        return $query->whereHas('roles', function($subQuery) {
                                            return $subQuery->whereIn('name', ['reviewer']);
                                        });
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

                            TinyEditor::make('content')->columnSpanFull()->profile('full')->maxHeight(500)->hiddenLabel(),
                            TagsInput::make('sources')->separator(',')

                        ])->collapsible(),

                        Section::make('Review Comments')->schema([
                            Livewire::make(CreateReview::class)->hidden(fn (?Model $record): bool => $record === null)
                        ])->collapsible(),

                    ]),

                    Tabs\Tab::make('SEO')->schema([

                    ]),

                    Tabs\Tab::make('Review')->schema([
                        Livewire::make(ListReviews::class)->hidden(fn (?Model $record): bool => $record === null)
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
                ToggleColumn::make('is_published')->label('Published'),
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
                TextColumn::make('updated_at')->label('Last Modified')->date()->sortable(),
            ])
            ->filters([
                DateScopeFilter::make('created_at'),

                SelectFilter::make('status')->options([
                    "D - Draft",
                    "I - Improve",
                    "C - Changes",
                    "R - Reject",
                    "F - Final",
                    "P - Published",
                    "FD - Final Database"
                ]),

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

            ], layout: FiltersLayout::AboveContent)->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filters'),
            )
            ->filtersFormColumns(6)
            ->filtersFormMaxHeight('400px')
            ->actions([
                EditAction::make()->button(),
                Action::make('review')
                    ->form([
                        TextInput::make('subject')->required(),
                        RichEditor::make('body')->required(),
                    ])
                    ->action(function (array $data) {
                        dd($data);
                    })->button()
            ], ActionsPosition::BeforeColumns)
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('Export as pdf File')
                        ->icon('heroicon-s-arrow-top-right-on-square')
                        ->requiresConfirmation()
                        ->color(Color::hex('#00569e'))
                        ->action(function (Collection $records) {

                            GenerateArticlePDF::dispatch($records)->onQueue('pdf');

                            Notification::make()
                                ->title('Export has been started!')
                                ->body('You will get a notification when your files are ready to download')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('Export as Word File')
                        ->icon('heroicon-s-arrow-top-right-on-square')
                        ->color(Color::hex('#00569e')),

                    DeleteBulkAction::make()
                ]),
            ])
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }
}
