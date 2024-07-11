<?php

namespace App\Filament\Resources\PreviousYearQuestionResource\Pages;

use App\Filament\Resources\PreviousYearQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreviousYearQuestions extends ListRecords
{
    protected static string $resource = PreviousYearQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
