<?php

namespace App\Filament\Resources\NewsTodayResource\Pages;

use App\Filament\Resources\NewsTodayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditNewsToday extends EditRecord
{
    protected static string $resource = NewsTodayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): Htmlable|string
    {
        return "";
    }
}
