<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

error_log("=== VERCEL BOOT START ===");
define('LARAVEL_START', microtime(true));

// Ensure APP_KEY is set (Vercel common pitfall)
if (empty(env('APP_KEY')) && empty($_ENV['APP_KEY']) && empty($_SERVER['APP_KEY'])) {
    error_log("WARNING: APP_KEY is missing! Cookies and sessions will not work correctly.");
}

error_log("Requiring autoload...");
require __DIR__ . '/../vendor/autoload.php';

// Set storage to /tmp on Vercel
$storagePath = '/tmp/storage';

// Redirect Laravel bootstrap cache paths to writable /tmp
$_SERVER['APP_SERVICES_CACHE'] = $storagePath . '/bootstrap/cache/services.php';
$_SERVER['APP_PACKAGES_CACHE'] = $storagePath . '/bootstrap/cache/packages.php';
$_SERVER['APP_ROUTES_CACHE'] = $storagePath . '/bootstrap/cache/routes.php';
$_SERVER['APP_EVENTS_CACHE'] = $storagePath . '/bootstrap/cache/events.php';

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

// Help Laravel identify the correct path behind Vercel rewrites
if (isset($_SERVER['HTTP_X_Vercel_Forwarded_For']) || isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['PHP_SELF'] = '/index.php';
}

error_log("Handling request...");
try {
    $request = Illuminate\Http\Request::capture();
    $app->handleRequest($request);
    error_log("Request handled successfully: " . $request->fullUrl());
} catch (\Throwable $e) {
    error_log("FATAL EXCEPTION: " . $e->getMessage());
    error_log($e->getTraceAsString());
    
    if (env('APP_DEBUG')) {
        echo "<h1>FATAL EXCEPTION</h1>";
        echo "<pre>" . $e->getMessage() . "\n" . $e->getTraceAsString() . "</pre>";
    }
    throw $e;
}
