<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\Action::make('Reset Password')
                ->hidden(function (Model $record) {

                    if(\Auth::user()->hasRole('super_admin')) return false;

                    if(\Auth::user()->email === $record->email) return true;

                    if($record->hasRole('super_admin')) return true;
                })
                ->form([
                    TextInput::make('password')
                        ->label('Create new password')
                        ->password()
                        ->required()
                        ->dehydrateStateUsing(fn (string $state): string => \Hash::make($state))
                ])
                ->action(function (array $data, Model $record) {
                    $record->update(['password' => $data['password']]);

                    Notification::make()
                        ->title('Password reset successful!')
                        ->success()
                        ->send();
                })->button(),

            Actions\Action::make('Disable Account')
                ->visible(function () {
                    return Auth::user()->can('disable_user');
                })
                ->hidden(function (Model $record) {

                    if(\Auth::user()->email === $record->email) return true;

                    if($record->hasRole('super_admin')) return true;

                    return $record->is_disabled;

                })
                ->color(Color::Red)
                ->requiresConfirmation()
                ->action(function(Model $record) {
                    $record->update(['is_disabled' => true]);

                    Notification::make()
                        ->title('Account has been disabled!')
                        ->success()
                        ->send();
                }),

            Actions\Action::make('Enable Account')
                ->hidden(function (Model $record) {
                    return !$record->is_disabled;
                })
                ->color(Color::Green)
                ->requiresConfirmation()
                ->action(function(Model $record) {
                    $record->update(['is_disabled' => false]);

                    Notification::make()
                        ->title('Account has been enabled!')
                        ->success()
                        ->send();
                }),
        ];
    }
}
