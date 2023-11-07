<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Carbon\Carbon;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Articles';

    public static function form(Form $form): Form
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
                    Textarea::make('excerpt'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Article ID'),
                TextColumn::make('title'),
                TextColumn::make('topic.name')->label('Subject'),
                TextColumn::make('topicSection.name')->label('Section'),
                TextColumn::make('topicSubSection.name')->label('Sub-Section'),
                TextColumn::make('author.name')->label('Expert'),
                TextColumn::make('reviewer.name')->label('Reviewer')
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Flatpickr::make('filter_range')->range()
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['filter_range'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['filter_range'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                })->indicateUsing(function (array $data): array {
                    $indicators = [];

                    if ($data['from'] ?? null) {
                        $indicators['from'] = 'Created from ' . Carbon::parse($data['from'])->toFormattedDateString();
                    }

                    if ($data['until'] ?? null) {
                        $indicators['until'] = 'Created until ' . Carbon::parse($data['until'])->toFormattedDateString();
                    }

                    return $indicators;
                }),

                SelectFilter::make('status')
                    ->multiple()
                    ->options([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ]),

                SelectFilter::make('Topic')
                    ->multiple()
                    ->options([
                        1 => "Polity",
                        2 => "International Relations",
                        3 => "Economy",
                        4 => "Security",
                        5 => "Environment",
                        6 => "Social",
                        7 => "Science & Tech",
                        8 => "Culture",
                        9 => "Ethics"
                    ])->attribute('initiative_topic_id'),

                SelectFilter::make('Initiative')
                    ->multiple()
                    ->options([
                        1 => "News Today",
                        2 => "Monthly Magazine",
                        3 => "Weekly Focus",
                        4 => "Mains 365",
                        5 => "PT 365",
                        6 => "Downloads"
                    ])->attribute('initiative_id'),

            ], layout: FiltersLayout::AboveContentCollapsible)->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filters'),
            )
            ->filtersFormColumns(5)
            ->filtersFormMaxHeight('400px')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
