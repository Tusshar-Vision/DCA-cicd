<?php

namespace App\Filament\Resources\DownloadsResource\Pages;

use App\Filament\Resources\DownloadsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditDownloads extends EditRecord
{
    protected static string $resource = DownloadsResource::class;

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
