<?php

return [
    'default' => env('CACHE_DRIVER', 'null'),

    'stores' => [
        'null' => [
            'driver' => 'null',
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'lock_connection' => 'default',
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'database' => [
            'driver' => 'database',
            'connection' => null,
            'table' => 'cache',
        ],
    ],

    'prefix' => env('CACHE_PREFIX', 'laravel_cache_'),
];
