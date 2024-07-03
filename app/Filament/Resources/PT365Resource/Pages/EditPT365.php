<?php

namespace App\Filament\Resources\PT365Resource\Pages;

use App\Filament\Resources\PT365Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPT365 extends EditRecord
{
    protected static string $resource = PT365Resource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }
}
