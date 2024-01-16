<?php

namespace App\Filament\Resources\RelatedTermsResource\Pages;

use App\Filament\Resources\RelatedTermResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelatedTerms extends ListRecords
{
    protected static string $resource = RelatedTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
