<?php

namespace App\Filament\Resources\NewsTodayResource\Pages;

use App\Filament\Resources\NewsTodayResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsToday extends CreateRecord
{
    protected static string $resource = NewsTodayResource::class;
}
