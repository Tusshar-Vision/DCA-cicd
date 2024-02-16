<?php

namespace App\Filament\Resources\YearEndReviewResource\Pages;

use App\Filament\Resources\YearEndReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYearEndReviews extends ListRecords
{
    protected static string $resource = YearEndReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
