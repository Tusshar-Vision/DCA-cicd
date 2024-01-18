<?php

namespace App\Filament\Resources\RelatedTermsResource\Pages;

use App\Filament\Resources\RelatedTermResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRelatedTerms extends EditRecord
{
    protected static string $resource = RelatedTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
