<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Logs extends \FilipFonal\FilamentLogManager\Pages\Logs
{
    public static function getNavigationGroup(): ?string
    {
        return "System"; // TODO: Change the autogenerated stub
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole(['Super Admin']);
    }
}