<?php

namespace App\Filament\Resources\WeeklyFocusResource\Pages;

use App\Filament\Resources\WeeklyFocusResource;
use App\Models\InitiativeTopic;
use App\Models\TopicSection;
use App\Models\TopicSubSection;
use Filament\Actions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class EditWeeklyFocus extends EditRecord
{
    protected static string $resource = WeeklyFocusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Upload Infographic')->steps([
                Step::make('Meta Information')->schema([
                    TextInput::make('title')->required(),

                    Group::make()->schema([
                        Select::make('initiative_topic_id')
                            ->options(InitiativeTopic::all()->pluck('name', 'id'))
                            ->required()
                            ->label('Subject')
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('topic_section_id', 0);
                                $set('topic_sub_section_id', 0);
                            }),

                        Select::make('topic_section_id')
                            ->options(function (Get $get) {
                                $topicID = $get('initiative_topic_id');
                                return TopicSection::where('topic_id', '=', $topicID)->pluck('name', 'id');
                            })
                            ->reactive()
                            ->label('Section')
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('topic_sub_section_id', 0);
                            }),

                        Select::make('topic_sub_section_id')
                            ->options(function (Get $get) {
                                $sectionID = $get('topic_section_id');
                                return TopicSubSection::where('section_id', '=', $sectionID)->pluck('name', 'id');
                            })
                            ->reactive()
                            ->label('Sub Section'),
                    ])->columns(3),

                    Group::make()->schema([

                        Select::make('language')
                            ->options([
                                "english" => "English",
                                "hindi" => "Hindi",
                            ])
                            ->required()
                            ->default('english'),

                    ])->columns(1),

                    Hidden::make('author_id')->default(function () {
                        return Auth::user()->id;
                    })
                ]),
                Step::make('Upload File')->schema([
                    SpatieMediaLibraryFileUpload::make('Infographic')
                        ->id('infographic')
                        ->collection('infographic')
                        ->required()
                        ->acceptedFileTypes([
                            'application/pdf',
                            'image/jpeg',
                            'image/png',
                            'image/svg'
                        ]),
                ])
            ])->action(function ($data) {
                dd($data);
            }),
            Actions\DeleteAction::make(),
        ];
    }
}
