<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\PersonalityInFocusResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Traits\Filament\VideoResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PersonalityInFocusResource extends Resource implements HasShieldPermissions
{
    use VideoResourceSchema;

    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationGroup = 'Videos';

    protected static ?string $modelLabel = 'Personality In Focus';
    protected static ?string $pluralLabel = 'Personality In Focus';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::PERSONALITY_IN_FOCUS)),

                    Forms\Components\Group::make()->schema([

                        DatePicker::make('published_at')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->label('Publish At')
                            ->required()
                            ->default(Carbon::now()->format('Y-m-d'))
                            ->live(),

                        Forms\Components\TextInput::make('name')
                            ->suffixAction(Forms\Components\Actions\Action::make('Generate')
                                ->icon('heroicon-s-cog-8-tooth')
                                ->iconButton()
                                ->action(function (callable $get, callable $set) {
                                    $set('name', static::generateName($get('published_at')));
                                })
                            )->required(),

                        Select::make('initiative_topic_id')
                            ->searchable()
                            ->preload()
                            ->relationship('topic', 'name')
                            ->required()
                            ->label('Subject')
                            ->required(),

//                        Select::make('language_id')
//                            ->relationship('language', 'name', function ($query) {
//                                return $query->orderBy('order_column');
//                            })
//                            ->label('Language')
//                            ->required()
//                            ->selectablePlaceholder(false)
//                            ->default(1),

                        Hidden::make('language_id')->default(1),

                        Forms\Components\SpatieMediaLibraryFileUpload::make('Upload pdf File')
                            ->name('file')
                            ->acceptedFileTypes(['application/pdf'])
                            ->collection('mains-365')
                            ->visibility('private')
                            ->visible(function (?PublishedInitiative $record) {
                                if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer'])) return true;
                                else if ($record !== null && $record->hasMedia('mains-365')) return true;
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

                    ])->columns(2)->columnSpanFull(),
                ]),
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
                InitiativesHelper::getInitiativeID(Initiatives::PERSONALITY_IN_FOCUS)
            )->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonalityInFoci::route('/'),
            'create' => Pages\CreatePersonalityInFocus::route('/create'),
            'edit' => Pages\EditPersonalityInFocus::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'create',
            'edit',
            'delete',
            'publish'
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('view_personality::in::focus');
    }

    public static function canEdit(Model $record): bool
    {
        if ($record->trashed()) {
            return false;
        }
        return Auth::user()->hasAnyRole(['super_admin', 'admin']) || (Auth::user()->can('edit_personality::in::focus') && $record->is_published !== true);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_personality::in::focus');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_personality::in::focus') && $record->is_published !== true;
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_personality::in::focus');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_personality::in::focus') && $record->is_published !== true;
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_personality::in::focus');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_personality::in::focus');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_personality::in::focus');
    }
}
