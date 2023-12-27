<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\NewsTodayResource\Pages;
use App\Filament\Resources\NewsTodayResource\RelationManagers\ArticlesRelationManager;
use App\Helpers\InitiativesHelper;
use App\Models\Article;
use App\Models\PublishedInitiative;
use App\Services\PublishedInitiativeService;
use App\Traits\Filament\InitiativeResourceSchema;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NewsTodayResource extends Resource
{
    protected static ?string $model = PublishedInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Create Articles';
    protected static ?string $modelLabel = 'News Today';
    protected static ?string $pluralLabel = 'News Today';

    protected static ?int $navigationSort = 1;

    use InitiativeResourceSchema;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Forms\Components\Hidden::make('initiative_id')
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY)),

                    DatePicker::make('published_at')
                        ->label('Publish At')
                        ->default(Carbon::now())
                        ->rules([
                            function (PublishedInitiativeService $publishedInitiativeService) {
                                return function (string $attribute, $value, \Closure $fail) use($publishedInitiativeService) {
                                    if  ($publishedInitiativeService->checkIfExists(InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY), $value)) {
                                        $fail('This date cannot be used as it already exists for this initiative, you can search it and add your articles in it.');
                                    }
                                };
                            }
                        ])
                        ->reactive(),

                    Toggle::make('is_published')
                        ->inline(false)
                        ->afterStateUpdated(function ($state, $livewire, ?Model $record, Article $articles, callable $get) {
                            $publishedInitiativeId = $record->id;
                            $publishedAt = $get('published_at');

                            $articles->where('published_initiative_id', '=', $publishedInitiativeId)->update([
                                'is_published' => $state,
                                'published_at' => $publishedAt,
                                'publisher_id' => Auth::user()->id
                            ]);

                            $livewire->dispatch('updatedPublishedStatus');
                        }),

                ])->columns(2),
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
            'index' => Pages\ListNewsTodays::route('/'),
            'create' => Pages\CreateNewsToday::route('/create'),
            'edit' => Pages\EditNewsToday::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query()
            ->where('initiative_id', InitiativesHelper::getInitiativeID(Initiatives::NEWS_TODAY))
            ->with('articles');

        if ($tenant = Filament::getTenant()) {
            static::scopeEloquentQueryToTenant($query, $tenant);
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user->can('view_any_news::today');
    }

    public static function canView(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('view_news::today');
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('update_news::today');
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        return $user->can('create_news::today');
    }

    public static function canDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('delete_news::today');
    }

    public static function canDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_any_news::today');
    }

    public static function canForceDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('force_delete_news::today');
    }

    public static function canForceDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_any_news::today');
    }

    public static function canReorder(): bool
    {
        $user = Auth::user();
        return $user->can('reorder_news::today');
    }

    public static function canReplicate(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('replicate_news::today');
    }

    public static function canRestore(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('restore_news::today');
    }

    public static function canRestoreAny(): bool
    {
        $user = Auth::user();
        return $user->can('restore_any_news::today');
    }
}
