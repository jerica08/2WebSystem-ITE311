<?php
// Minimal autoloader for CodeIgniter 4
// This is a temporary fix until Composer dependencies can be properly installed

// Define basic constants
if (!defined('APPPATH')) {
    define('APPPATH', realpath(__DIR__ . '/../app/') . DIRECTORY_SEPARATOR);
}
if (!defined('SYSTEMPATH')) {
    define('SYSTEMPATH', realpath(__DIR__ . '/../system/') . DIRECTORY_SEPARATOR);
}
if (!defined('ROOTPATH')) {
    define('ROOTPATH', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
}
if (!defined('WRITEPATH')) {
    define('WRITEPATH', realpath(__DIR__ . '/../writable/') . DIRECTORY_SEPARATOR);
}

// Basic autoloader function
spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $file = str_replace(['\\', 'CodeIgniter\\'], ['/', ''], $class);
    
    // Try system directory first
    $systemFile = SYSTEMPATH . $file . '.php';
    if (file_exists($systemFile)) {
        require_once $systemFile;
        return;
    }
    
    // Try app directory
    $appFile = APPPATH . str_replace('App\\', '', $file) . '.php';
    if (file_exists($appFile)) {
        require_once $appFile;
        return;
    }
});

// Load essential CodeIgniter files
$essentialFiles = [
    SYSTEMPATH . 'Common.php',
    SYSTEMPATH . 'Config/Services.php',
    SYSTEMPATH . 'Config/BaseService.php',
];

foreach ($essentialFiles as $file) {
    if (file_exists($file)) {
        require_once $file;
    }
}
?>
