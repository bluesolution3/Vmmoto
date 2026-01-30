<?php
require_once __DIR__ . '/config.php';

$controller = $_GET['controller'] ?? 'categoryImport';
$action     = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controller) . 'Controller';
$controllerFile  = APP_PATH . "/Controllers/$controllerClass.php";

if (!file_exists($controllerFile)) {
    die("Controller not found: $controllerFile");
}

require_once $controllerFile;
$controllerObject = new $controllerClass($pdo);

if (!method_exists($controllerObject, $action)) {
    die("Action not found");
}

$controllerObject->$action();
