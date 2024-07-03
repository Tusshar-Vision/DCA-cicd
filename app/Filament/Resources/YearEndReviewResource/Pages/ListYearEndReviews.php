<?php

namespace App\Filament\Resources\YearEndReviewResource\Pages;

use App\Filament\Resources\YearEndReviewResource;
use App\Traits\Filament\Components\PublishedTab;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYearEndReviews extends ListRecords
{
    protected static string $resource = YearEndReviewResource::class;

    use PublishedTab;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
