<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\DownloadsResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Traits\Filament\MoreResourceSchema;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ValueAddedOptionalResource extends Resource
{
    use MoreResourceSchema;

    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?int $navigationSort = 9;
    protected static ?string $modelLabel = 'Value Added Material (Optional)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL_OPTIONAL)),


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

                    Forms\Components\SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->name('file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('value-added-material-optional')
                        ->visibility('private')
                        ->visible(function (?PublishedInitiative $record) {
                            if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer'])) return true;
                            else if ($record !== null && $record->hasMedia('value-added-material-optional')) return true;
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDownloads::route('/'),
            'create' => Pages\CreateDownloads::route('/create'),
            'edit' => Pages\EditDownloads::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::VALUE_ADDED_MATERIAL_OPTIONAL))
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_value::added::optional');
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->hasAnyRole(['super_admin', 'admin']) || (Auth::user()->can('edit_value::added::optional') && $record->is_published !== true);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_value::added::optional');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_value::added::optional') && $record->is_published !== true;
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_value::added::optional');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_value::added::optional') && $record->is_published !== true;
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_value::added::optional');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_value::added::optional');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_value::added::optional');
    }
}
