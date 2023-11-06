<?php

namespace App\Filament\Resources\InfographicsResource\Pages;

use App\Filament\Resources\InfographicsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfographics extends EditRecord
{
    protected static string $resource = InfographicsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
