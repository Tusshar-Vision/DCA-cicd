<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\EconomicSurveyResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Traits\Filament\MoreResourceSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class EconomicSurveyResource extends Resource
{
    use MoreResourceSchema;

    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 7;

    protected static ?string $modelLabel = 'Economic Survey';

    protected static ?string $navigationIcon = 'heroicon-o-currency-rupee';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::ECONOMIC_SURVEY)),

                    Group::make()->schema([

                        DatePicker::make('published_at')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label('Publish At')
                            ->required()
                            ->default(Carbon::now()->format('Y-m-d'))
                            ->live()
                            ->afterStateUpdated(
                                function (Set $set, ?string $state) {
                                    if ($state !== null)
                                        $set('name', static::generateName($state));
                                }),

                        TextInput::make('name')->default(function (callable $get) {
                            return static::generateName($get('published_at'));
                        })->required(),

                        Select::make('initiative_topic_id')
                            ->relationship('topic', 'name', function ($query) {
                                return $query->orderBy('order_column');
                            })
                            ->required()
                            ->label('Subject')
                            ->default(3)
                            ->required(),

                        Select::make('language_id')
                            ->relationship('language', 'name', function ($query) {
                                return $query->orderBy('order_column');
                            })
                            ->label('Language')
                            ->required()
                            ->default(1),

                    ])->columns(2)->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->name('file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('economic-survey')
                        ->required()
                        ->columnSpanFull(),

                ])->columns(2),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where(
                'initiative_id',
                InitiativesHelper::getInitiativeID(Initiatives::ECONOMIC_SURVEY)
            );

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
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
            'index' => Pages\ListEconomicSurveys::route('/'),
            'create' => Pages\CreateEconomicSurvey::route('/create'),
            'edit' => Pages\EditEconomicSurvey::route('/{record}/edit'),
        ];
    }
}
