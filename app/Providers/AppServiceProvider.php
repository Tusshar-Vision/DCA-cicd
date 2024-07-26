<?php

namespace App\Providers;

use App\Cdn\CdnAwsS3Provider;
use App\Cdn\CdnFacade;
use App\Cdn\CdnProviderFactory;
use App\Helpers\CustomEncrypter;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Publiux\laravelcdn\Contracts\CdnFacadeInterface;
use Publiux\laravelcdn\Contracts\ProviderFactoryInterface;
use Publiux\laravelcdn\Providers\Contracts\ProviderInterface;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('dev')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton(CustomEncrypter::class, function() {
            return new CustomEncrypter();
        });

        $this->app->bind(ProviderInterface::class, CdnAwsS3Provider::class);
        $this->app->bind(ProviderFactoryInterface::class, CdnProviderFactory::class);
        $this->app->bind(CdnFacadeInterface::class, CdnFacade::class);

        $this->app->singleton('CDN', function ($app) {
            return $app->make('App\Cdn\CdnFacade');
        });
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
            Js::make('ckeditor', __DIR__ . '/../../resources/js/filament/components/ckeditor.js'),
            Css::make('ckeditor', __DIR__ . '/../../resources/css/filament/components/ckeditor.css'),
            AlpineComponent::make('ck-editor-component', __DIR__ . '/../../resources/dist/components/ck-editor-component.js'),
        ]);
    }
}
