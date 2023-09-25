<?php

namespace App\Filament\Resources\NewsTodayResource\Pages;

use App\Filament\Resources\NewsTodayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsToday extends EditRecord
{
    protected static string $resource = NewsTodayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
