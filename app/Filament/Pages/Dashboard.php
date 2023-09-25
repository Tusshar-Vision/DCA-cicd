<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\InitiativesPublishedChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UsersChart;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
{
    return [
        StatsOverview::class,
        UsersChart::class,
        InitiativesPublishedChart::class
    ];
}
}
