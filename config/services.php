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

    'kafka' => [
        'broker' => env('KAFKA_BROKERS'),
        'security_protocol' => env('SECURITY_PROTOCOL'),
        'sasl' => [
            'mechanisms' => env('SASL_MECHANISMS'),
            'username' => env('SASL_USERNAME'),
            'password' => env('SASL_PASSWORD'),
        ],
    ],
];
