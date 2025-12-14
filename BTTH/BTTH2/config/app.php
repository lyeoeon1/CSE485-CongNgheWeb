<?php
define('BASE_URL', 'http://localhost/cse485/BTTH2');
define('APP_NAME', 'Online Course Management');
define('UPLOAD_PATH', 'public/assets/uploads/');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS

session_start();

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        'app/Controllers/',
        'app/Models/',
        'app/Core/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>