<?php

return [
    'route' => [
        'prefix' => 'payment',
        'as' => 'payment.',
    ],

    'storage' => [
        // optioins: eloquent, filesystem
        'token' => 'eloquent',

        // optioins: eloquent, filesystem
        'gatewayConfig' => 'eloquent',
    ],

    'gatewayConfigs' => [
    'paypal_rest'=>[
            'factory'  => 'paypal-rest',
            'client_id' => 'AfMGFi1jXzgJZt2JvdMK5KSqgRrD-xRrozoOrOahS0aJ7Tu53oNRkIKkqZbpbKPCXESn3XZslTspjejs',
            'client_secret' => 'EPazGHgeXrvDgZb-HvtL6tocqwBT1R-6K57vQFktYexGJCeIjqGQDPebEtTJuaW9pKwMX2mFI5s_tVHE',
            'sandbox'  => true,
            'config_path'=>'payum'
    ],
    'paypal_express_checkout'=>[
            'factory'  => 'paypal_express_checkout',
            'username' =>'karki.kuber_api1.gmail.com',
            'password' =>'An5ns1Kso7MWUdW4ErQKJJJ4qi4-ASuSuCUJVsm.Tdya5GhFc7JzkhJC',
            'signature'    =>'An5ns1Kso7MWUdW4ErQKJJJ4qi4-ASuSuCUJVsm.Tdya5GhFc7JzkhJC',
            'client_id' => 'AfMGFi1jXzgJZt2JvdMK5KSqgRrD-xRrozoOrOahS0aJ7Tu53oNRkIKkqZbpbKPCXESn3XZslTspjejs',
            'client_secret' => 'EPazGHgeXrvDgZb-HvtL6tocqwBT1R-6K57vQFktYexGJCeIjqGQDPebEtTJuaW9pKwMX2mFI5s_tVHE',
            'sandbox'  => true,
            'cmd' => 'Api::CMD_EXPRESS_CHECKOUT',
            'config_path'=>'payum'
    ],
     'offline'=>[
             'factory'  => 'offline',
            
     ],
        // 'customFactoryName' => [
        //     'factory'  => 'FactoryClass',
        //     'username' => 'username',
        //     'password' => 'password',
        //     'sandbox'  => false
        // ],
    ],
];
