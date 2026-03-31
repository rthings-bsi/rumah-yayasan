<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

error_log("=== VERCEL BOOT START ===");
define('LARAVEL_START', microtime(true));

error_log("Requiring autoload...");
require __DIR__ . '/../vendor/autoload.php';

// Set storage to /tmp on Vercel
$storagePath = '/tmp/storage';

// Redirect Laravel bootstrap cache paths to writable /tmp
$_SERVER['APP_SERVICES_CACHE'] = $storagePath . '/bootstrap/cache/services.php';
$_SERVER['APP_PACKAGES_CACHE'] = $storagePath . '/bootstrap/cache/packages.php';
$_SERVER['APP_ROUTES_CACHE'] = $storagePath . '/bootstrap/cache/routes.php';
$_SERVER['APP_EVENTS_CACHE'] = $storagePath . '/bootstrap/cache/events.php';
$_ENV['APP_SERVICES_CACHE'] = $storagePath . '/bootstrap/cache/services.php';
$_ENV['APP_PACKAGES_CACHE'] = $storagePath . '/bootstrap/cache/packages.php';
$_ENV['APP_ROUTES_CACHE'] = $storagePath . '/bootstrap/cache/routes.php';
$_ENV['APP_EVENTS_CACHE'] = $storagePath . '/bootstrap/cache/events.php';

error_log("Bootstrapping app...");
$app = require_once __DIR__.'/../bootstrap/app.php';

error_log("Setting storage path...");
$app->useStoragePath($storagePath);

$directories = [
    "$storagePath/app/public",
    "$storagePath/framework/cache/data",
    "$storagePath/framework/sessions",
    "$storagePath/framework/testing",
    "$storagePath/framework/views",
    "$storagePath/logs",
    "$storagePath/bootstrap/cache",
];

error_log("Creating directories...");
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

error_log("Handling request...");
try {
    $app->handleRequest(Illuminate\Http\Request::capture());
    error_log("Request handled successfully.");
} catch (\Throwable $e) {
    error_log("FATAL EXCEPTION: " . $e->getMessage());
    error_log($e->getTraceAsString());
    throw $e;
}
