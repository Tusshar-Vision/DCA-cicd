<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelatedTermsResource\Pages;
use App\Models\RelatedTerm;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RelatedTermResource extends Resource
{
    protected static ?string $model = RelatedTerm::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Create Articles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('term')->required(),
                Textarea::make('description')->required()->rows(5)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->toggleable(),
                Tables\Columns\TextColumn::make('term'),
                Tables\Columns\TextColumn::make('description')->limit(40)
                    ->tooltip(fn (Model $record): string => $record->description),
                Tables\Columns\TextColumn::make('created_at')->date('d M Y h:i a')->sortable()->toggleable()
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
            'index' => Pages\ListRelatedTerms::route('/'),
            'create' => Pages\CreateRelatedTerms::route('/create'),
            'edit' => Pages\EditRelatedTerms::route('/{record}/edit'),
        ];
    }
}
