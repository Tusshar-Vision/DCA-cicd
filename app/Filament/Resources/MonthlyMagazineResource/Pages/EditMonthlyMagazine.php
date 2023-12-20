<?php

namespace App\Filament\Resources\MonthlyMagazineResource\Pages;

use App\Filament\Resources\MonthlyMagazineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditMonthlyMagazine extends EditRecord
{
    protected static string $resource = MonthlyMagazineResource::class;

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
