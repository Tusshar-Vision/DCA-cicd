<?php

namespace App\Filament\Resources\PreviousYearQuestionResource\Pages;

use App\Filament\Resources\PreviousYearQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreviousYearQuestion extends EditRecord
{
    protected static string $resource = PreviousYearQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
