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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // ── TGI PAY (TGIPAY) ───────────────────────────────────────────────────
    'tgipay' => [
        'integration_key' => env('TGIPAY_INTEGRATION_KEY'),
        'private_key'     => env('TGIPAY_SECRET'),
        'base_url'        => env('TGIPAY_BASE_URL', 'https://integration-service.tgipay.com/integration/api/v1'),
        'callback_url'    => env('TGIPAY_CALLBACK_URL', env('APP_URL') . '/tgipay/callback'),
    ],

];
