<?php
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/App');
require_once __DIR__ . '/vendor/autoload.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'vemotto');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
