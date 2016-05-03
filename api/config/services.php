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
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'username' => 'ses-smtp-user.20160502-163225', // Not used
        'key'    => 'AKIAI3DMZ77NV5BUYQBA',
        'secret' => '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',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => PathoTrack\User::class,
        'key'    => '',
        'secret' => '',
    ],

];
