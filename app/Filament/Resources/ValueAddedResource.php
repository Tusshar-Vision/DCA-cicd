<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\ValueAddedResource\Pages;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ValueAddedResource extends Resource
{
    use MoreResourceSchema;

    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 8;

    protected static ?string $modelLabel = 'Value Added Material';

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL)),

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
                        ->collection('value-added-material')
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

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where(
                'initiative_id',
                InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL)
            );

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListValueAddeds::route('/'),
            'create' => Pages\CreateValueAdded::route('/create'),
            'edit' => Pages\EditValueAdded::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_value::added');
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('edit_value::added');
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        return $user->can('create_value::added');
    }

    public static function canDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('delete_value::added');
    }

    public static function canDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_value::added');
    }

    public static function canForceDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('delete_value::added');
    }

    public static function canForceDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_value::added');
    }
}
