<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?int $navigationSort = -2;

    public static function form(Form $form): Form
    {
        $super_admin = config('filament-shield.super_admin.name');
        $admin = 'admin';

        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('General')->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->placeholder('example@visionias.in')
                            ->disabledOn('edit'),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->dehydrateStateUsing(fn (string $state): string => \Hash::make($state))
                            ->hiddenOn('edit')
                    ])->columnSpan(1),

                    Forms\Components\Section::make('User Roles')->description('You can assign multiple roles to one user.')->schema([

                        Select::make('roles')->multiple()->relationship('roles', 'name', function ($query) use($super_admin, $admin) {
                            if(\Auth::user()->hasRole($super_admin)) {
                                return $query;
                            } else {
                                return $query->whereNotIn('name', [$super_admin, $admin]);
                            }
                        })->preload()->required(),

                    ])->columnSpan(1)
                ])->columns(2)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        $super_admin = config('filament-shield.super_admin.name');
        $admin = 'admin';

        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('roles.name')->separator(',')->badge(),
                IconColumn::make('is_disabled')->label('Is Enabled')
                    ->boolean()
                    ->falseIcon('heroicon-o-check-badge')
                    ->falseColor(Color::Green)
                    ->trueIcon('heroicon-o-x-mark')
                    ->trueColor(Color::Red)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\BulkAction::make('Assign Roles')
                        ->icon('heroicon-s-user-plus')
                        ->color(Color::Green)
                        ->form([

                            Select::make('roles')->multiple()->options(function () use($super_admin, $admin) {

                                if(\Auth::user()->hasRole($super_admin)) {
                                    return Role::all()->pluck('name', 'name')->toArray();
                                } else {
                                    return Role::whereNotIn('name', [$super_admin, $admin])->pluck('name', 'name')->toArray();
                                }

                            })->required(),

                        ])->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use($data) {
                               $record->assignRole($data['roles']);
                            });

                            Notification::make()
                                ->title('You have been assigned roles by the admin')
                                ->body(implode(', ', $data['roles']))
                                ->success()
                                ->sendToDatabase($records);

                            Notification::make()
                                ->title('Roles assigned successfully')
                                ->success()
                                ->send();

                        })->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('Disable accounts')
                        ->icon('heroicon-s-shield-exclamation')
                        ->color(Color::Red)
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                $record->update(['is_disabled' => true]);
                            });

                            Notification::make()
                                ->title('Account has been disabled!')
                                ->success()
                                ->send();

                    })->deselectRecordsAfterCompletion(),

                ]),
            ])
            ->checkIfRecordIsSelectableUsing(
                fn (Model $record): bool => !$record->hasRole('super_admin'),
            )
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
