<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\WeeklyFocusResource\RelationManagers\ArticlesRelationManager;
use App\Filament\Resources\WeeklyFocusResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\InitiativeTopic;
use App\Models\PublishedInitiative;
use App\Models\TopicSection;
use App\Models\TopicSubSection;
use App\Services\MediaService;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\InitiativeResourceSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WeeklyFocusResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'Weekly Focus';
    protected static ?string $pluralLabel = 'Weekly Focus';

    protected static ?int $navigationSort = 2;

    use InitiativeResourceSchema;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General')->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS)),


                    Forms\Components\Group::make()->schema([
                        DatePicker::make('published_at')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label('Publish At')
                            ->required()
                            ->default(Carbon::now()->format('Y-m-d'))
                            ->rules([
                                function (PublishedInitiativeService $publishedInitiativeService, ?Model $record) {

                                    if ($record !== null) {
                                        return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService, $record) {
                                            if (
                                                Carbon::parse($record->published_at)
                                                    ->format('Y-m-d') === Carbon::parse($value)->format('Y-m-d')
                                            ) {}

                                            else if  (
                                                $publishedInitiativeService
                                                    ->checkIfExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
                                                        $value
                                                    )
                                            ) {
                                                $fail('This week cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                            }
                                        };
                                    }

                                    return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                        if  (
                                                $publishedInitiativeService
                                                    ->checkIfExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
                                                        $value
                                                    )
                                            ) {
                                            $fail('This week cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                        }
                                    };
                                }
                            ])
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state !== null)
                                    $set('name', static::generateName($state));
                                }),

                        Forms\Components\TextInput::make('name')->default(function (callable $get) {
                            return static::generateName($get('published_at'));
                        })
                            ->rules([
                                function (PublishedInitiativeService $publishedInitiativeService, ?Model $record) {

                                    if ($record !== null) {
                                        return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService, $record) {
                                            if (
                                                $record->name === $value
                                            ) {}

                                            elseif  (
                                                $publishedInitiativeService
                                                    ->checkIfNameExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
                                                        $value
                                                    )
                                            ) {
                                                $fail('This name cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                            }
                                        };
                                    }

                                    return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                        if  (
                                            $publishedInitiativeService
                                                ->checkIfNameExists(
                                                    InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS),
                                                    $value
                                                )
                                        ) {
                                            $fail('This name cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                        }
                                    };
                                }
                            ])
                            ->required(),

                    ])->columns(2)->columnSpanFull(),

                    Select::make('language_id')
                        ->relationship('language', 'name', function ($query) {
                            return $query->orderBy('order_column');
                        })
                        ->label('Language')
                        ->required()
                        ->default(1),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('pdf')
                        ->label('Upload pdf file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('weekly-focus')
                        ->visibility('private')
                        ->openable()
                        ->columnSpanFull(),

                ])
                ->columnSpan(1)
                ->columns(2),

                Forms\Components\Section::make('Topic at a glance')
                    ->schema([
                        Select::make('infographic_id')
                            ->label('Infographic')
                            ->relationship('infographic', 'title')
                            ->createOptionForm([
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

                                        Select::make('language_id')
                                            ->relationship('language', 'name', function ($query) {
                                                return $query->orderBy('order_column');
                                            })
                                            ->required()
                                            ->default(1),

                                    ])->columns(1),

                                    Hidden::make('author_id')->default(function () {
                                        return Auth::user()->id;
                                    }),

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
                            ]),
                    ])->columnSpan(1)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ArticlesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeeklyFoci::route('/'),
            'create' => Pages\CreateWeeklyFocus::route('/create'),
            'edit' => Pages\EditWeeklyFocus::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::WEEKLY_FOCUS))
            ->with('articles');

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

}
