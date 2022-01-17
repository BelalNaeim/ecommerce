<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'secret' => env('sk_test_51KFh18Jnbx4GcaTfIqgjLXkF8UCB3a4DsKQZIHy9NYQEQVSMYnXDz8y43BihhKsNsKxlR6tBkO1bNPfDAG52KcjZ002jL2f4IB'),
    ],
    'google' => [
        'client_id' => '939942281675-483fsdpek0pg761uo7go4csb0ttt5ghs.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/pro/ecommerce/callback/google',
      ],

];
