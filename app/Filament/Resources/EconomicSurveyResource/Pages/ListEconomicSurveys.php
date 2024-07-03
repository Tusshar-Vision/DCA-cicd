<?php

namespace App\Filament\Resources\EconomicSurveyResource\Pages;

use App\Filament\Resources\EconomicSurveyResource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEconomicSurveys extends ListRecords
{
    protected static string $resource = EconomicSurveyResource::class;

    use PublishedTab;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
