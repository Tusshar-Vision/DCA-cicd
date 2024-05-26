<?php

namespace App\Filament\Resources\NewsTodayUploadResource\Pages;

use App\Filament\Resources\NewsTodayUploadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsTodayUpload extends EditRecord
{
    protected static string $resource = NewsTodayUploadResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }
}
