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
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    
    'facebook' => [
        'client_id' => '155486285097804',
        'client_secret' => '9125ad564fb2c46227613149ee0885a3',
        'redirect' => env('APP_URL').'/auth/facebook/callback',
    ],
    'twitter' => [
        'client_id' => '9IAtQ493PHIWtIpZWW7Wa3yuo',
        'client_secret' => 'UsrDlDwiP2puVZfzAtqRfL197i1wj7FuN5XrowgkqxblBa5LJp',
        'redirect' => env('APP_URL').'/auth/twitter/callback',
    ],
    'google' => [
        'client_id' => '522256387096-3q0hsfmntm3l18mvvis9jcntfcfgo3tj.apps.googleusercontent.com',
        'client_secret' => 'IDNexpPvw3UltwIY5JyXknXV',
        'redirect' => env('APP_URL').'/auth/google/callback',
    ],

];
