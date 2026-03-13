<?php

return [
    'host' => env('IMMICH_HOST', '127.0.0.1'),

    'port' => env('IMMICH_PORT', 2283),

    'secure' => env('IMMICH_SECURE', false),

    'api_endpoint' => env('IMMICH_API_ENDPOINT', '/api'),

    'program' => env('IMMICH_PROGRAM', 'immich'),

    'defaults' => [
        'recursive' => true,
        'skip_hash' => false,
        'include_hidden' => false,
    ],
];
