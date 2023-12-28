<?php

namespace App\Traits\Filament\Components;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use RalphJSmit\Filament\SEO\SEO;

trait ArticleForm
{
    public function articleForm(Form $form): Form {

        return $form
            ->schema([

                Tabs::make('Tabs')->tabs([

                    Tabs\Tab::make('Content')->schema([

                        Section::make('General')->schema([

                            Group::make()->schema([

                                Group::make()->schema([
                                    TextInput::make('title')->required(),
                                    Textarea::make('excerpt')->label('Description'),
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

                                Hidden::make('author_id')
                                    ->default(function ($get) {
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
                                    ->required()
                                    ->label('Subject')
                                    ->reactive(),

                                Select::make('topic_section_id')
                                    ->relationship('topicSection', 'name', function ($query, callable $get) {
                                        $topic = $get('initiative_topic_id');

                                        return $query->where('topic_id', '=', $topic);
                                    })
                                    ->reactive()
                                    ->label('Section'),

                                Select::make('topic_sub_section_id')
                                    ->relationship('topicSubSection', 'name', function ($query, callable $get) {
                                        $topicSectionId = $get('topic_section_id');

                                        return $query->where('section_id', '=', $topicSectionId);
                                    })->reactive()
                                    ->label('Sub Section'),

                            ])->columns(1),

                            Group::make()->schema([

                                Select::make('language')
                                    ->options([
                                        "english" => "English",
                                        "hindi" => "Hindi",
                                    ])
                                    ->required()
                                    ->default('english'),

                                SpatieTagsInput::make('tags')
                                    ->required(),

                            ])->columns(1)

                        ])->columns(2)->collapsible(),

                        Section::make('Content')->schema([

                            TinyEditor::make('content')
                                ->columnSpanFull()
                                ->profile('full')
//                                ->toolbarSticky(true)
                                ->maxHeight(500)
                                ->hiddenLabel(),
                            TagsInput::make('sources')
                                ->separator(',')
                                ->placeholder('New Source')

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
}