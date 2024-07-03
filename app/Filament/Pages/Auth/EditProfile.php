<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Forms\Components\Component;
use Filament\Support\Exceptions\Halt;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Password;

class EditProfile extends BaseEditProfile
{
    protected function getCurrentPasswordFormComponent(): Component
    {
        return TextInput::make('current_password')
            ->label(__('Current password'))
            ->rule(Password::default())
            ->revealable(filament()->arePasswordsRevealable())
            ->password()
            ->required();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getCurrentPasswordFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),

                Select::make('roles')
                    ->label('My Roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->disabled(),
            ]);
    }

    /**
     * @throws Halt
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (array_key_exists('password', $data)) {
            $currentPassword = $data['current_password'];

            // Check if the current password matches the user's password
            if (!Hash::check($currentPassword, $record->password)) {
                $this->addError('current_password', 'The current password is incorrect.');
                throw new Halt(); // Return the record without updating if the password is incorrect
            }

            // Remove the current password from the data array
            $this->data['current_password'] = null;
            unset($data['current_password']);
        }

        // Update the record with the new data
        $record->update($data);
        return $record;
    }
}
