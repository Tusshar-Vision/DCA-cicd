<?php

namespace App\Filament\Resources\YearEndReviewResource\Pages;

use App\Filament\Resources\YearEndReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYearEndReview extends EditRecord
{
    protected static string $resource = YearEndReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
