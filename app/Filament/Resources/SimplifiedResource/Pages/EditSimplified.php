<?php

namespace App\Filament\Resources\SimplifiedResource\Pages;

use App\Filament\Resources\SimplifiedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSimplified extends EditRecord
{
    protected static string $resource = SimplifiedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
