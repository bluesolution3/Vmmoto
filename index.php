<?php
require_once __DIR__ . "/config.php";

$controller = $_GET['controller'] ?? 'configuration';
$action     = $_GET['action'] ?? 'index';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - VeMotto</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            height: 100vh;
            background: #212529;
            color: #fff;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }
        .sidebar a:hover {
            background: #343a40;
            color: #fff;
        }
        .sidebar .active {
            background: #0d6efd;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <h5 class="p-3 border-bottom">Admin Panel</h5>

            <a href="index.php?controller=configuration&action=index"
               class="<?= ($controller == 'configuration') ? 'active' : '' ?>">
               <i class="bi bi-gear"></i> Configuration
            </a>

            <a href="index.php?controller=promotion&action=index"
               class="<?= ($controller == 'promotion') ? 'active' : '' ?>">
               <i class="bi bi-megaphone"></i> Promotions
            </a>

        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">

            <!-- Success Alert -->
            <?php if (isset($_GET['success'])): ?>
<div class="alert alert-success d-flex align-items-center shadow-sm rounded-3 p-3 mb-4 fade show" role="alert" style="border-left: 5px solid #28a745;">
    <i class="bi bi-check-circle-fill me-2" style="font-size:1.5rem;"></i>
    <div>
        <strong>Success!</strong> Portal settings have been updated successfully.
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

            <!-- Dynamic Controller Loader -->
            <?php
            $controllerFile = __DIR__ . "/App/Controllers/" . ucfirst($controller) . "Controller.php";

            if (file_exists($controllerFile)) {
                require_once $controllerFile;

                $className = ucfirst($controller) . "Controller";

                if (class_exists($className)) {
                    $ctrl = new $className($pdo);

                    if (method_exists($ctrl, $action)) {
                        $ctrl->$action();
                    } else {
                        echo "<div class='alert alert-danger'>Action <strong>$action</strong> not found in controller <strong>$className</strong>.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Class <strong>$className</strong> not found inside file.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Controller file <strong>$controllerFile</strong> not found.</div>";
            }
            ?>

        </div>

    </div>
</div>

<!-- Bootstrap JS (for alert dismiss) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
