<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

error_log("=== VERCEL BOOT START ===");
define('LARAVEL_START', microtime(true));

error_log("Requiring autoload...");
require __DIR__ . '/../vendor/autoload.php';

// Ensure APP_KEY is set (Vercel common pitfall)
if (empty(getenv('APP_KEY')) && empty($_ENV['APP_KEY']) && empty($_SERVER['APP_KEY'])) {
    error_log("WARNING: APP_KEY is missing! Cookies and sessions will not work correctly.");
}

// Set storage to /tmp on Vercel
$storagePath = '/tmp/storage';

// Redirect Laravel bootstrap cache paths to writable /tmp
$_SERVER['APP_SERVICES_CACHE'] = $storagePath . '/bootstrap/cache/services.php';
$_SERVER['APP_PACKAGES_CACHE'] = $storagePath . '/bootstrap/cache/packages.php';
$_SERVER['APP_ROUTES_CACHE'] = $storagePath . '/bootstrap/cache/routes.php';
$_SERVER['APP_EVENTS_CACHE'] = $storagePath . '/bootstrap/cache/events.php';

error_log("Bootstrapping app...");
$app = require_once __DIR__.'/../bootstrap/app.php';

error_log("Setting paths...");
$app->useStoragePath($storagePath);
$app->usePublicPath(__DIR__ . '/../public');

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
    
    // Diagnostic: Check if manifest exists
    $manifestPath = public_path('build/manifest.json');
    $manifestExists = file_exists($manifestPath);
    error_log("DIAGNOSTIC: Public Path = " . public_path());
    error_log("DIAGNOSTIC: Manifest Path = $manifestPath");
    error_log("DIAGNOSTIC: Manifest Exists = " . ($manifestExists ? "YES" : "NO"));
    
    // Check root directory contents
    $root = base_path();
    error_log("DIAGNOSTIC: Root Path = $root");
    error_log("DIAGNOSTIC: Root contents: " . implode(', ', scandir($root)));
    if (is_dir("$root/public")) {
        error_log("DIAGNOSTIC: Public contents: " . implode(', ', scandir("$root/public")));
        if (is_dir("$root/public/build")) {
            error_log("DIAGNOSTIC: Public/build contents: " . implode(', ', scandir("$root/public/build")));
        }
    }

    if (!$manifestExists) {
        $altManifest = public_path('build/.vite/manifest.json');
        error_log("DIAGNOSTIC: Checking alt manifest: $altManifest (" . (file_exists($altManifest) ? "YES" : "NO") . ")");
    }

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
