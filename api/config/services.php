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
        'key'    => 'AKIAJBBFH3KX2P56RRMQ',
        'secret' => 'AsxJBt+0Au3YE7kT1tMdnRxziwZX1hLgDDyvKjvfKhYQ',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => PathoTrack\User::class,
        'key'    => '',
        'secret' => '',
    ],

];
