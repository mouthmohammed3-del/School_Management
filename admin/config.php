<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'electronic_library');

// Site configuration
define('SITE_NAME', 'Electronic School Library');
define('SITE_URL', 'http://localhost/project/');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>