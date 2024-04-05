<?php

namespace App\Filament\Resources\ThePlanetVisionResource\Pages;

use App\Filament\Resources\ThePlanetVisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditThePlanetVision extends EditRecord
{
    protected static string $resource = ThePlanetVisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
