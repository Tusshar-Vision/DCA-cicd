<?php

namespace App\Filament\Resources\QuarterlyRevisionResource\Pages;

use App\Filament\Resources\QuarterlyRevisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuarterlyRevision extends EditRecord
{
    protected static string $resource = QuarterlyRevisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
