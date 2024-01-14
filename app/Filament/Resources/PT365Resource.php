<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\PT365Resource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\OtherUploadsResourceSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PT365Resource extends Resource
{
    use OtherUploadsResourceSchema;

    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'PT 365';
    protected static ?string $pluralLabel = 'PT 365';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::PT_365)),


                    Forms\Components\Group::make()->schema([
                        DatePicker::make('published_at')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label('Publish At')
                            ->required()
                            ->default(Carbon::now()->format('Y-m-d'))
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state !== null)
                                    $set('name', static::generateName($state));
                            }),

                        Forms\Components\TextInput::make('name')->default(function (callable $get) {
                            return static::generateName($get('published_at'));
                        })
                            ->required(),
                    ])->columns(2)->columnSpanFull(),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->name('file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('pt-365')
                        ->required()
                        ->columnSpanFull(),

                ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPT365S::route('/'),
            'create' => Pages\CreatePT365::route('/create'),
            'edit' => Pages\EditPT365::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::PT_365));

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_p::t365');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->can('edit_p::t365');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_p::t365');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_p::t365');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_p::t365');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_p::t365');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_p::t365');
    }
}
