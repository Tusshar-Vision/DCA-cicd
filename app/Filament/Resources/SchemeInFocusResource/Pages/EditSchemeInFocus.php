<?php

namespace App\Filament\Resources\SchemeInFocusResource\Pages;

use App\Filament\Resources\SchemeInFocusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchemeInFocus extends EditRecord
{
    protected static string $resource = SchemeInFocusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
