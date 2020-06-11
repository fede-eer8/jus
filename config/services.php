<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => LegalIS\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyDKt2EOtxeHzNHhrEN3wRFSmdGUH41dJHg',
        'auth_domain' => 'legalis-11902.firebaseapp.com',
        'database_url' => 'https://legalis-11902.firebaseio.com',
        'secret' => 'rQVpgmfMa8RIqsmpavEHG8hkMnEYtiFIVEwkgOe6',
        'storage_bucket' => 'legalis-11902.appspot.com',
    ],

];
