<?php

namespace App\Filament\Resources;

use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Croustibat\FilamentJobsMonitor\Resources\QueueMonitorResource;

class JobResource extends QueueMonitorResource implements HasShieldPermissions
{
    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
        ];
    }
}
