<?php

namespace App\Filament\Resources\RelatedTermsResource\Pages;

use App\Filament\Resources\RelatedTermResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRelatedTerms extends CreateRecord
{
    protected static string $resource = RelatedTermResource::class;
}
