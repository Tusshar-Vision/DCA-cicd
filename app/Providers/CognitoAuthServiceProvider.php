<?php

namespace App\Providers;

use App\Auth\CognitoGuard;
use Illuminate\Support\ServiceProvider;
use App\Helpers\CognitoClient;
use Illuminate\Foundation\Application;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class CognitoAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        $this->app->singleton(CognitoClient::class, function (Application $app) {
            $config = [
                'credentials' => [
                    'key'       => config('aws.access_key.id'),
                    'secret'    => config('aws.access_key.secret')
                ],
                'region'    => config('aws.cognito.region'),
                'version'   => config('aws.cognito.version')
            ];

            return new CognitoClient(
                new CognitoIdentityProviderClient($config),
                config('aws.cognito.client_id'),
                config('aws.cognito.client_secret'),
                config('aws.cognito.user_pool_id')
            );
        });
    }
}
