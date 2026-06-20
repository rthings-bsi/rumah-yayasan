<?php
// Laravel development server router
if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

// Determine the application path
$appPath = __DIR__;

// Serve static files if they exist
if (file_exists($uri = $appPath . '/public' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

require $appPath . '/public/index.php';
