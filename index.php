<?php
require_once 'config.php';
require_once 'App/Models/CustomerPhoneModel.php';
require_once 'App/Controllers/CustomerPhoneController.php';

$model = new CustomerPhoneModel($conn);
$controller = new CustomerPhoneController($model);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    case 'status':
        $controller->toggleStatus();
        break;
    case 'verify':
        $controller->verify();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
}
