<?php

$config = require 'config.php';

try {
    $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}";
    $pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}

$controllerName = ucfirst($_GET['controller'] ?? 'business') . 'Controller';
$action = $_GET['action'] ?? 'index';

require_once __DIR__ . "/App/Controllers/{$controllerName}.php";

$controller = new $controllerName($pdo);

if (!method_exists($controller, $action)) {
    die('Invalid action');
}

$controller->$action();
