<?php

namespace App\Filament\Resources\DownloadsResource\Pages;

use App\Filament\Resources\ValueAddedOptionalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditDownloads extends EditRecord
{
    protected static string $resource = ValueAddedOptionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): Htmlable|string
    {
        return "";
    }
}
