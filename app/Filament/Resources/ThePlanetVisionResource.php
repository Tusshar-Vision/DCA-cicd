<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\ThePlanetVisionResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Traits\Filament\OtherUploadsResourceSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ThePlanetVisionResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-asia-australia';

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 12;

    protected static ?string $modelLabel = 'Planet Vision';
    protected static ?string $pluralLabel = 'Planet Vision';

    use OtherUploadsResourceSchema;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::PLANET_VISION)),

                    Group::make()->schema([

                        DatePicker::make('published_at')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label('Publish At')
                            ->required()
                            ->default(Carbon::now()->format('Y-m-d'))
                            ->live(),

                        TextInput::make('name')
                            ->suffixAction(Action::make('Generate')
                                ->icon('heroicon-s-cog-8-tooth')
                                ->iconButton()
                                ->action(function (callable $get, callable $set) {
                                    $set('name', static::generateName($get('published_at')));
                                })
                            )->required(),

                        Select::make('initiative_topic_id')
                            ->searchable()
                            ->preload()
                            ->relationship('topic', 'name', function ($query) {
                                return $query->orderBy('order_column');
                            })
                            ->required()
                            ->label('Subject')
                            ->required(),

//                        Select::make('language_id')
//                            ->selectablePlaceholder(false)
//                            ->relationship('language', 'name', function ($query) {
//                                return $query->orderBy('order_column');
//                            })
//                            ->label('Language')
//                            ->required()
//                            ->default(1),
                        Hidden::make('language_id')->default(1),

                    ])->columns(2)->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->name('file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('planet-vision')
                        ->visibility('private')
                        ->visible(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer'])) return true;
                            else if ($record !== null && $record->hasMedia('planet-vision')) return true;
                            else return false;
                        })
                        ->openable()
                        ->deletable(function (?PublishedInitiative $record) {
                            if ($record !== null && $record->is_published === true) {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                            } else {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin', 'reviewer']);
                            }
                        })
                        ->required()
                        ->columnSpanFull(),

                ])->columns(2),
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
            'index' => Pages\ListThePlanetVisions::route('/'),
            'create' => Pages\CreateThePlanetVision::route('/create'),
            'edit' => Pages\EditThePlanetVision::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::PLANET_VISION))
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }
}
