<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubSectionResource\Pages;
use App\Filament\Resources\SubSectionResource\RelationManagers;
use App\Models\SubSection;
use App\Models\TopicSubSection;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\Filament\NestedResources\Ancestor;
use Guava\Filament\NestedResources\Resources\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\Livewire;

class SubSectionResource extends NestedResource
{
    protected static ?string $model = TopicSubSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('section_id')
                    ->relationship('section', 'name')
                    ->default(function () {
                        preg_match('/sections\/(\d+)/', URL::current(), $matches);
                        return $matches[1];
                    })
                    ->required()
                    ->label('Section'),
                TextInput::make('name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('topic.name')->label('Subject'),
                Tables\Columns\TextColumn::make('name'),
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

    public static function getAncestor() : ?Ancestor
    {
        return Ancestor::make(
            SectionResource::class, // Parent Resource Class
        );
    }

    public static function getPages(): array
    {
        return [
            'create' => Pages\CreateSubSection::route('/create'),
            'edit' => Pages\EditSubSection::route('/{record}/edit'),
        ];
    }
}
