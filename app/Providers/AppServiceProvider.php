<?php

namespace App\Providers;

use App\Enums\Initiatives;
use App\Models\Initiative;
use App\Services\InitiativeService;
use Filament\Facades\Filament;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;

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
     * @throws \Throwable
     */
    public function boot(): void
    {
        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            UsedDiskSpaceCheck::new(),
        ]);

        FilamentAsset::register([
            AlpineComponent::make('ck-editor-component', __DIR__ . '/../../resources/js/dist/components/ck-editor-component.js'),
        ]);
    }
}
