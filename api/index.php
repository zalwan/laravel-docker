<?php

if (getenv('VERCEL')) {
    $runtimeDatabase = '/tmp/database.sqlite';
    $templateDatabase = __DIR__ . '/../database/vercel.sqlite';

    foreach (['/tmp/views', '/tmp/cache'] as $directory) {
        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    if (! file_exists($runtimeDatabase) && file_exists($templateDatabase)) {
        copy($templateDatabase, $runtimeDatabase);
    }
}

require __DIR__ . '/../public/index.php';
