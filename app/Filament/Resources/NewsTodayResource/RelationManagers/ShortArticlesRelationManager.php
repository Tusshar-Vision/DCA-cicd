<?php

namespace App\Filament\Resources\NewsTodayResource\RelationManagers;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Enums\Initiatives;
use App\Filament\Components\Repeater;
use App\Forms\Components\CKEditor;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Traits\Filament\ArticleRelationSchema;
use Filament\Forms\Components\Actions\Action;
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
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as Livewire;
use RalphJSmit\Filament\SEO\SEO;

class ShortArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'shortArticles';

    protected static ?string $title = 'Also in News';

    use ArticleRelationSchema;

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Tabs')->tabs([

                    Tabs\Tab::make('Article Content')->schema([

                        Section::make('General')->schema([

                            Group::make()->schema([
                                TextInput::make('title')->required(),
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

                        Section::make('Category')->schema([

                            Group::make()->schema([

                                Hidden::make('initiative_id')->default(function(Livewire $livewire) {
                                    return $livewire->ownerRecord->initiative_id;
                                }),

                                Hidden::make('is_short')->default(true),

                                Select::make('initiative_topic_id')
                                    ->relationship('topic', 'name')
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
                                    ->relationship('topicSection', 'name', function ($query, callable $get) {
                                        $topic = $get('initiative_topic_id');

                                        return $query->where('topic_id', '=', $topic);
                                    })
                                    ->default(function (Livewire $livewire) {
                                        return $livewire->ownerRecord->topic_section_id;
                                    })
                                    ->reactive()
                                    ->label('Section')
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        $set('topic_sub_section_id', null);
                                    }),

                                Select::make('topic_sub_section_id')
                                    ->relationship('topicSubSection', 'name', function ($query, callable $get) {
                                        $topicSectionId = $get('topic_section_id');

                                        return $query->where('section_id', '=', $topicSectionId);
                                    })
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
                            ->columns(2)
                            ->collapsible(),

                        Section::make('Content')
                            ->relationship('content')
                            ->schema([
                                CKEditor::make('content'),

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

                        TagsInput::make('sources')
                            ->separator(',')
                            ->placeholder('New Source')
                    ]),
                ])->columnSpanFull(),
            ]);
    }
}
