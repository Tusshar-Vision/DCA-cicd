<?php

namespace App\Filament\Resources;

use App\Enums\Initiatives;
use App\Filament\Resources\PT365Resource\Pages;
use App\Helpers\InitiativesHelper;
use App\Models\PublishedInitiative;
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
                Forms\Components\Section::make('New Initiative')->schema([
                    Select::make('initiative_id')
                        ->options([
                            4 => 'Mains 365',
                            5 => 'PT 365',
                            6 => 'Downloads'
                        ])
                        ->label('Initiative')
                        ->required()
                        ->default(InitiativesHelper::getInitiativeID(Initiatives::PT_365)),
                    DatePicker::make('published_at')->default(today()),
                    SpatieMediaLibraryFileUpload::make('file')
                        ->name('file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->collection('pt365')
                        ->required()
                        ->storeFileNamesIn('name'),
                    TextInput::make('name')->label('File Name')->placeholder('Add Custom Name or File Name will be used'),
                    Toggle::make('is_published')->inline(false)
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name'),
                ToggleColumn::make('is_published')->inline(false),
                TextColumn::make('published_at')->dateTime('d M Y h:m')->label('Published At')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
        $user = Auth::user();
        return $user->can('view_any_p::t365');
    }

    public static function canView(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('view_p::t365');
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('update_p::t365');
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        return $user->can('create_p::t365');
    }

    public static function canDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('delete_p::t365');
    }

    public static function canDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_any_p::t365');
    }

    public static function canForceDelete(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('force_delete_p::t365');
    }

    public static function canForceDeleteAny(): bool
    {
        $user = Auth::user();
        return $user->can('delete_any_p::t365');
    }

    public static function canReorder(): bool
    {
        $user = Auth::user();
        return $user->can('reorder_p::t365');
    }

    public static function canReplicate(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('replicate_p::t365');
    }

    public static function canRestore(Model $record): bool
    {
        $user = Auth::user();
        return $user->can('restore_p::t365');
    }

    public static function canRestoreAny(): bool
    {
        $user = Auth::user();
        return $user->can('restore_any_p::t365');
    }
}
