<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>
 */

return [
    'mode' => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username' => env('PAYPAL_SANDBOX_API_USERNAME', 'karki.kuber_api1.gmail.com'),
        'password' => env('PAYPAL_SANDBOX_API_PASSWORD', 'YPZ2VJPMNNKW8V7F'),
        'secret' => env('PAYPAL_SANDBOX_API_SECRET', 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-ASuSuCUJVsm.Tdya5GhFc7JzkhJC'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id' => 'APP-80W284485P519543T',    // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username' => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password' => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret' => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),        
        'app_id' => 'APP-26819740R3062954D',         // Used for Adaptive Payments API 
    ],

    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency' => 'USD',
    'notify_url' => url('/'), // Change this accordingly for your application.
];
