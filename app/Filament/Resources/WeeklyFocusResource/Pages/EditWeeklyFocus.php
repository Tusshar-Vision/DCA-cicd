<?php

namespace App\Filament\Resources\WeeklyFocusResource\Pages;

use App\Filament\Resources\WeeklyFocusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeeklyFocus extends EditRecord
{
    protected static string $resource = WeeklyFocusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
