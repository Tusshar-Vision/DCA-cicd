<?php

return [

    'access_key' => [
        'id' =>  env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_ACCESS_KEY_SECRET'),
    ],

    'cognito' => [
        'region' => env('AWS_COGNITO_REGION', 'ap-south-1'),
        'version' => env('AWS_COGNITO_VERSION', '2016-04-18'),
        'user_pool_id' => env('AWS_COGNITO_USER_POOL_ID'),
        'client_id' => env('AWS_COGNITO_CLIENT_ID'),
        'client_secret' => env('AWS_COGNITO_CLIENT_SECRET'),
    ],
];