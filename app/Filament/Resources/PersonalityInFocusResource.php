<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Enums\InitiativeTopics;
use App\Filament\Resources\PersonalityInFocusResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Models\Video;
use App\Traits\Filament\VideoResourceSchema;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component as Livewire;

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
                            ->label('Subject'),

//                        Select::make('language_id')
//                            ->relationship('language', 'name', function ($query) {
//                                return $query->orderBy('order_column');
//                            })
//                            ->label('Language')
//                            ->required()
//                            ->selectablePlaceholder(false)
//                            ->default(1),

                        Hidden::make('language_id')->default(1),

                    ]),
                ])->columnSpan(1),

                Forms\Components\Section::make("Video")
                    ->schema([
                        Select::make('video_id')
                            ->hiddenLabel()
                            ->searchable()
                            ->relationship('video', 'title')
                            ->createOptionForm([
                                Section::make()->schema([
                                    TextInput::make('title')->required(),
                                    Textarea::make('description')->label('Description'),
                                    SpatieTagsInput::make('tags')
                                        ->required(),

                                    Hidden::make('initiative_topic_id')
                                        ->default(InitiativesHelper::getInitiativeTopicID(InitiativeTopics::ALL))
                                        ->required()
                                ])->columnSpan(1),

                                Section::make()->schema([

                                    Toggle::make('is_url')
                                        ->label('Provide URL')
                                        ->reactive(),

                                    SpatieMediaLibraryFileUpload::make('Video')
                                        ->hidden(function (callable $get) {
                                            return $get('is_url');
                                        })
                                        ->id('video')
                                        ->collection('video')
                                        ->visibility('private')
                                        ->visible(function (?Video $record) {
                                            if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer'])) return true;
                                            else if ($record !== null && $record->hasMedia('infographic')) return true;
                                            else return false;
                                        })
                                        ->openable()
                                        ->deletable(function (?Video $record) {
                                            if ($record !== null && $record?->is_published === true) {
                                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                                            } else {
                                                return Auth::user()->hasAnyRole(['admin', 'super_admin', 'reviewer']);
                                            }
                                        })
                                        ->required()
                                        ->acceptedFileTypes([
                                            'video/mp4',         // MP4 videos
                                            'video/webm',        // WebM videos
                                            'video/ogg',
                                        ])
                                        ->previewable(),

                                    TextInput::make('url')
                                        ->visible(function (callable $get) {
                                            return $get('is_url');
                                        })
                                        ->label('Video URL')
                                        ->required()
                                        ->activeUrl(true),

                                    Group::make()->schema([

                                        Hidden::make('language_id')
                                            ->required()
                                            ->default(function (Livewire $livewire) {
                                                return $livewire->record->language_id;
                                            }),

                                    ])->columns(1),

                                    Hidden::make('author_id')->default(function () {
                                        return Auth::user()->id;
                                    })

                                ])->columnSpan(1)
                            ])
                            ->disabled(function ($operation) {
                                if ($operation === 'create') return true;
                                if (Auth::user()->can('edit_personality::in::focus')) return false;
                                else return true;
                            }),
                    ])->columnSpan(1)
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
