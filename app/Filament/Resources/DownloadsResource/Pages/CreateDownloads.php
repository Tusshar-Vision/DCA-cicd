<?php

namespace App\Filament\Resources\DownloadsResource\Pages;

use App\Filament\Resources\ValueAddedOptionalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDownloads extends CreateRecord
{
    protected static string $resource = ValueAddedOptionalResource::class;
}
