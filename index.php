<?php
require_once "config.php";

$controller = $_GET['controller'] ?? 'promotion';
$action = $_GET['action'] ?? 'index';
?>

<!DOCTYPE html>
<html>
<head>
    <title>VeMotto Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background-color:#f4f6f9;">

<div class="container mt-5">

<?php
if ($controller == 'promotion') {
    require_once "App/Controllers/PromotionController.php";
    $ctrl = new PromotionController($pdo);
    $ctrl->$action();
}
?>

</div>

</body>
</html>
