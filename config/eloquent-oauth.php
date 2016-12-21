<?php

use App\User;

return [
    'model' => User::class,
    'table' => 'oauth_identities',
    'providers' => [
        'facebook' => [
            'client_id' => '1164771373610687',
            'client_secret' => 'e52399bdfc8d6891a32843e78b88dfea',
            'redirect_uri' => 'http://eventdayplanner.com/public/dev',
            'scope' => [],
        ],
        'google' => [
            'client_id' => '521125266075-6a4lg5bsh6b924aq6igguu4rd960ejho.apps.googleusercontent.com',
            'client_secret' => 'enOpVGZe06dDZ66pVmuOkz46',
            'redirect_uri' => env('GOOGLE_REDIRECT','http://eventdayplanner.com/auth/callback/google')
        ],
        'github' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/github/redirect',
            'scope' => [],
        ],
        'linkedin' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/linkedin/redirect',
            'scope' => [],
        ],
        'instagram' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/instagram/redirect',
            'scope' => [],
        ],
        'soundcloud' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
            'scope' => [],
        ],
    ],
];
