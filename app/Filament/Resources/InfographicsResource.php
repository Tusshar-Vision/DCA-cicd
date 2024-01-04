<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfographicsResource\Pages;
use App\Filament\Resources\InfographicsResource\RelationManagers;
use App\Models\Infographic;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InfographicsResource extends Resource
{
    protected static ?string $model = Infographic::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Media';

    protected static ?string $label = 'Infographic';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Upload Infographic')->schema([
                    Forms\Components\SpatieMediaLibraryFileUpload::make('Infographic')
                        ->id('infographic')
                        ->collection('infographic')
                        ->acceptedFileTypes(['application/pdf']),

                        Forms\Components\TextInput::make('title')->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->icon('heroicon-s-eye')
                    ->tooltip('Preview')
                    ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->tooltip('Edit')
                    ->iconButton(),
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
            'index' => Pages\ListInfographics::route('/'),
            'create' => Pages\CreateInfographics::route('/create'),
            'edit' => Pages\EditInfographics::route('/{record}/edit'),
        ];
    }
}
