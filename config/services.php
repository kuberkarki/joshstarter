<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
            'client_id'     => '1164771373610687',
            'client_secret' => 'e52399bdfc8d6891a32843e78b88dfea',
            'redirect'      => 'http://eventdayplanner.com',
        ],
    'google' => [
        'client_id'     => env('GOOGLE_ID','521125266075-6a4lg5bsh6b924aq6igguu4rd960ejho.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_SECRET','enOpVGZe06dDZ66pVmuOkz46'),
        'redirect'      => env('GOOGLE_REDIRECT','http://eventdayplanner.com/dev/public/auth/callback/google')
    ],
    'twitter' => [
        'client_id'     => env('TWITTER_ID','LqYhaavfPT0AseUjU98QJzOWz'),
        'client_secret' => env('TWITTER_SECRET','2apNDtElmF3MNRA1UvxgQAhazWpoNe0ngenLEzuyE8WASytn4'),
        'redirect'      => env('TWITTER_REDIRECT','http://eventdayplanner.com/dev/public/auth/callback/twitter')
    ],
    'linkedin' => [
        'client_id'     => env('LINKEDIN_ID','81l9han96op5a7'),
        'client_secret' => env('LINKEDIN_SECRET','dffszywxB9giUWrx'),
        'redirect'      => env('LINKEDIN_REDIRECT','http://eventdayplanner.com/dev/public/auth/callback/linkedin')
    ],

];
