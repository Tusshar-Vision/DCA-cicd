<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('System Logs')
                    ->url(config('app.url') . '/' . config('log-viewer.route_path'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-exclamation-circle')
                    ->activeIcon('heroicon-s-exclamation-circle')
                    ->group('Reports')
                    ->sort(3),
            ]);
        });
    }
}
