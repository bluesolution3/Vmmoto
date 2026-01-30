<?php

require_once __DIR__ . '/config.php';

$config = require __DIR__ . '/config.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
        $config['db']['user'],
        $config['db']['pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
} catch (PDOException $e) {
    die('DB Connection Failed: ' . $e->getMessage());
}

$controllerName = $_GET['controller'] ?? 'dashboard';

$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . "/App/Controllers/{$controllerClass}.php";

if (!file_exists($controllerFile)) {
    die('Controller not found');
}

require_once $controllerFile;

$controller = new $controllerClass($pdo);
$controller->index();
