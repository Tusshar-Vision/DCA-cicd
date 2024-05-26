<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\NewsTodayUploadResource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\MainUploadsPdfUploadSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NewsTodayUploadResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Other Uploads';

    protected static ?string $modelLabel = 'News Today';
    protected static ?string $pluralLabel = 'News Today';

    protected static ?int $navigationSort = 1;

    use MainUploadsPdfUploadSchema;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)),

                    Group::make()->schema([
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

                                            elseif  (
                                                $publishedInitiativeService
                                                    ->checkIfExists(
                                                        InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
                                                        $value
                                                    )
                                            ) {
                                                $fail('This date cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                            }
                                        };
                                    }

                                    return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                        if  (
                                            $publishedInitiativeService
                                                ->checkIfExists(
                                                    InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
                                                    $value
                                                )
                                        ) {
                                            $fail('This date cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                        }
                                    };
                                }
                            ])
                            ->disabled(function (?PublishedInitiative $record) {
                                if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                                else if ($record?->is_published) return true;
                            })
                            ->live(),

                        TextInput::make('name')
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
                                                        InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
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
                                                    InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY),
                                                    $value
                                                )
                                        ) {
                                            $fail('This name cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                        }
                                    };
                                }
                            ])
                            ->required()
                            ->suffixAction(Action::make('Generate')
                                ->icon('heroicon-s-cog-8-tooth')
                                ->iconButton()
                                ->action(function (callable $get, callable $set) {
                                    $set('name', static::generateName($get('published_at')));
                                })
                            ),

                    ])->disabled(function (?PublishedInitiative $record) {
                        if (Auth::user()->hasAnyRole(['super_admin', 'admin'])) return false;
                        else if ($record?->is_published) return true;
                    })->columns(2)->columnSpanFull(),

                    Hidden::make('language_id')->default(1),

                    SpatieMediaLibraryFileUpload::make('Upload pdf File')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('news-today')
                        ->visibility('private')
                        ->openable()
                        ->disabled(function (?PublishedInitiative $record) {
                            if (Auth::user()->can('upload_news::today')) return false;
                            else if ($record !== null && $record->hasMedia('news-today')) return false;
                            else return true;
                        })
                        ->deletable(function (?PublishedInitiative $record) {
                            if ($record !== null && $record->is_published === true) {
                                return Auth::user()->hasAnyRole(['admin', 'super_admin']);
                            } else {
                                return Auth::user()->can('upload_news::today');
                            }
                        })
                        ->columnSpanFull(),

                ])
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
            'index' => Pages\ListNewsTodayUploads::route('/'),
            'create' => Pages\CreateNewsTodayUpload::route('/create'),
            'edit' => Pages\EditNewsTodayUpload::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->with('articles', function ($query) {
                return $query->with(['statuses']);
            })
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
        return Auth::user()->can('view_news::today');
    }

    public static function canEdit(Model $record): bool
    {
        $userId = Auth::id(); // Get the current authenticated user's ID
        if ($record->trashed()) {
            return false;
        }
        return Auth::user()->hasAnyRole(['super_admin', 'admin', 'reviewer', 'news_today_reviewer']) || (Auth::user()->can('edit_news::today') && $record->articles->contains(function ($article) use ($userId) {
                    return $article?->reviewer_id == $userId || $article->author_id == $userId;
                }));
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('create_news::today');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->can('delete_news::today') && $record->is_published !== true;
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canForceDelete(Model $record): bool
    {
        return Auth::user()->can('delete_news::today') && $record->is_published !== true;
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canRestore(Model $record): bool
    {
        return Auth::user()->can('delete_news::today');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('delete_news::today');
    }
}
