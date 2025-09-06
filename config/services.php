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

    'rapidapi' => [
        'key' => env('RAPIDAPI_KEY'),
    ],

    'edamam' => [
        'app_id' => env('EDAMAM_APP_ID'),
        'app_key' => env('EDAMAM_APP_KEY'),
    ],

    'facebook' => [
        'client_id' => '1118728875311723',
        'client_secret' => '4bc7c89cb29a7dfd636da93889152d0b',
        'redirect' => 'https://claires-recipes.uk/auth/facebook/callback',
    ],

];
