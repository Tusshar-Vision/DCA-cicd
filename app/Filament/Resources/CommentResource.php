<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class CommentResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?string $navigationLabel = 'User Comments';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('Author')
                    ->defaultImageUrl(function (Model $record) {
                        $first_initial = mb_substr($record->user->name, 0, 1);
                        return 'https://ui-avatars.com/api/?name=' . $first_initial . '&color=FFFFFF&background=09090b';
                    })
                    ->circular()
                    ->tooltip(function (Model $record) {
                        return $record->user->name;
                    }),
                TextColumn::make('content')->label('Comment'),
                TextColumn::make('created_at')->date('M d, Y, h:i a'),
                Tables\Columns\IconColumn::make('is_approved'),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\Action::make('View Comment')
                    ->button()->form(function (Model $record) {
                        return [
                          Forms\Components\TextInput::make('Comment')->label('')->default($record->content)->disabled()
                        ];
                    }),

                Tables\Actions\Action::make('Approve')
                    ->button()
                    ->hidden(function (Model $record) {
                        return $record->is_approved;
                    })
                    ->action(function (Model $record) {
                        $record->update(['is_approved' => true]);
                    }),

                Tables\Actions\Action::make('Disapprove')
                    ->button()
                    ->visible(function (Model $record) {
                        return $record->is_approved;
                    })
                    ->action(function (Model $record) {
                        $record->update(['is_approved' => false]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('Approve comments')
                        ->action(function (Collection $records) {
                           $records->each(function ($record) {
                               $record->update(['is_approved' => true]);
                           });
                        })->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'approve',
            'reply'
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
//            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
