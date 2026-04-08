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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'api_football' => [
        'base_url' => env('API_FOOTBALL_BASE_URL', 'https://v3.football.api-sports.io'),
        'key' => env('API_FOOTBALL_KEY'),
        'team_id' => (int) env('API_FOOTBALL_TEAM_ID', 645),
        'league_id' => (int) env('API_FOOTBALL_LEAGUE_ID', 0),
        'season' => (int) env('API_FOOTBALL_SEASON', 0),
        'timeout' => (int) env('API_FOOTBALL_TIMEOUT', 10),
    ],

    'api_football_wc' => [
        'base_url' => env('API_FOOTBALL_WC_BASE_URL', env('API_FOOTBALL_BASE_URL', 'https://v3.football.api-sports.io')),
        'key' => env('API_FOOTBALL_WC_KEY', env('API_FOOTBALL_KEY')),
        'team_id' => (int) env('API_FOOTBALL_WC_TEAM_ID', 645),
        'league_id' => (int) env('API_FOOTBALL_WC_LEAGUE_ID', 0),
        'season' => (int) env('API_FOOTBALL_WC_SEASON', 0),
        'timeout' => (int) env('API_FOOTBALL_WC_TIMEOUT', env('API_FOOTBALL_TIMEOUT', 10)),
    ],

];
