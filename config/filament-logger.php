<?php
return array(
    'datetime_format' => 'd/m/Y H:i:s',
    'date_format' => 'd/m/Y',

    'activity_resource' => \Z3d0X\FilamentLogger\Resources\ActivityResource::class,

    'resources' => array(
        'enabled' => true,
        'log_name' => 'Resource',
        'logger' => \Z3d0X\FilamentLogger\Loggers\ResourceLogger::class,
        'color' => 'success',
        'exclude' => array(
            //App\Filament\Resources\UserResource::class,
        ),
    ),

    'nav' => [
      'group' => ''
    ],

    'access' => array(
        'enabled' => true,
        'logger' => \Z3d0X\FilamentLogger\Loggers\AccessLogger::class,
        'color' => 'danger',
        'log_name' => 'Access',
    ),

    'notifications' => array(
        'enabled' => true,
        'logger' => \Z3d0X\FilamentLogger\Loggers\NotificationLogger::class,
        'color' => null,
        'log_name' => 'Notification',
    ),

    'models' => array(
        'enabled' => true,
        'log_name' => 'Model',
        'color' => 'warning',
        'logger' => \Z3d0X\FilamentLogger\Loggers\ModelLogger::class,
        'register' => array(
            //App\Models\User::class,
        ),
    ),

    'custom' => array(
        // [
        //     'log_name' => 'Custom',
        //     'color' => 'primary',
        // ]
    ),
);
