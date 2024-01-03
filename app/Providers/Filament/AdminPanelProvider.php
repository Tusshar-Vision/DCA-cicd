<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\Middleware\SyncSpatiePermissionsWithFilamentTenants;
use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Resources\ArticleResource;
use App\Filament\Resources\CommentResource;
use App\Filament\Resources\DownloadsResource;
use App\Filament\Resources\InfographicsResource;
use App\Filament\Resources\Mains365Resource;
use App\Filament\Resources\MonthlyMagazineResource;
use App\Filament\Resources\NewsTodayResource;
use App\Filament\Resources\PT365Resource;
use App\Filament\Resources\SectionResource;
use App\Filament\Resources\SubjectResource;
use App\Filament\Resources\SubSectionResource;
use App\Filament\Resources\VideoResource;
use App\Filament\Resources\WeeklyFocusResource;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Croustibat\FilamentJobsMonitor\FilamentJobsMonitorPlugin;
use EightyNine\Approvals\ApprovalPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->plugins([
                OverlookPlugin::make()
                    ->includes([
                        ArticleResource::class,
                        NewsTodayResource::class,
                        WeeklyFocusResource::class,
                        MonthlyMagazineResource::class,
                        Mains365Resource::class,
                        PT365Resource::class,
                        DownloadsResource::class,
                        InfographicsResource::class,
                        VideoResource::class,
                        CommentResource::class,
                    ])
                    ->sort(2)
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 4,
                        'xl' => 5,
                        '2xl' => null,
                    ]),
                FilamentJobsMonitorPlugin::make()
                    ->label('Job')
                    ->pluralLabel('Jobs')
                    ->enableNavigation()
                    ->navigationIcon('heroicon-o-cpu-chip')
                    ->navigationGroup('System')
                    ->navigationSort(5)
                    ->navigationCountBadge(true)
                    ->enablePruning(true)
                    ->pruningRetention(7),
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 4,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile(EditProfile::class)
            ->colors([
                'primary' => Color::hex('#005faf'),
            ])
            ->brandLogo(asset('images/LightLogo.svg'))
            ->darkModeBrandLogo(asset('images/LightLogo.svg'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                 Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                OverlookWidget::class
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authGuard('web')
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()
            ->navigationGroups([
                'System',
                'User Management',
                'Create Articles',
                'Other Uploads',
                'Media'
            ])
            ->sidebarCollapsibleOnDesktop()
            ->spa(true);
    }
}
