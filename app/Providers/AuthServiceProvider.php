<?php

namespace App\Providers;

use App\Models\Paper;
use App\Policies\ActivityPolicy;
use App\Policies\MediaPolicy;
use App\Policies\PaperPolicy;
use App\Policies\QueueMonitorPolicy;
use App\Policies\RolePolicy;
use App\Policies\TagPolicy;
use Croustibat\FilamentJobsMonitor\Models\QueueMonitor;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Role;
use Spatie\Tags\Tag;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Activity::class => ActivityPolicy::class,
        Tag::class => TagPolicy::class,
        QueueMonitor::class => QueueMonitorPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
