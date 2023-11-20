<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

class ApplicationHealth extends HealthCheckResults
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