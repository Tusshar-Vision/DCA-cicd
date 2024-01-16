<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InitiativeResource\Pages;
use App\Filament\Resources\InitiativeResource\RelationManagers;
use App\Models\Initiative;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InitiativeResource extends Resource
{
    protected static ?string $model = Initiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = "Create Initiatives";

    protected static ?string $navigationGroup = 'Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('path')->required(),
                Select::make('parent_id')
                    ->label('Parent Initiative')
                    ->options(
                        Initiative::where('parent_id', '=', null)
                            ->get()
                            ->pluck('name', 'id')
                    ),
                TextInput::make('name_hindi')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_column')
            ->reorderRecordsTriggerAction(
                fn (Action $action, bool $isReordering) => $action
                    ->button()
                    ->label($isReordering ? 'Disable reordering' : 'Enable reordering'),
            )
            ->defaultSort('order_column')
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('path'),
                TextColumn::make('name_hindi'),
                TextColumn::make('parent_id')->label('Parent')->default('Individual')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInitiatives::route('/'),
            'create' => Pages\CreateInitiative::route('/create'),
            'edit' => Pages\EditInitiative::route('/{record}/edit'),
        ];
    }
}
