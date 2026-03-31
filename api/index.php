<?php

/**
 * Forward Vercel requests to the normal Laravel index.php
 */
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

// Set storage to /tmp on Vercel
$storagePath = '/tmp/storage';

$app->useStoragePath($storagePath);

$directories = [
    "$storagePath/app/public",
    "$storagePath/framework/cache/data",
    "$storagePath/framework/sessions",
    "$storagePath/framework/views",
    "$storagePath/logs",
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Handle request
$app->handleRequest(Illuminate\Http\Request::capture());
