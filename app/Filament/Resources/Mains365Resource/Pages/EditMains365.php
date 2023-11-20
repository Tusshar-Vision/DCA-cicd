<?php

namespace App\Filament\Resources\Mains365Resource\Pages;

use App\Filament\Resources\Mains365Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMains365 extends EditRecord
{
    protected static string $resource = Mains365Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}