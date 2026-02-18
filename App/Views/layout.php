<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VeMotto Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-oMIIhJL1T5s+PxJr6+Qb0pO1IRFB6OGMM+J57UBT3UQKxSVsb++MkXpu9cLqaJxu" crossorigin="anonymous">

    <!-- Optional: CoreUI Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/icons@2.1.0/css/all.min.css" rel="stylesheet">

    <!-- Optional: Your Custom CSS -->
    <link href="public/assets/css/custom.css" rel="stylesheet">
</head>
<body class="c-app">

<!-- Sidebar -->
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <h3 class="text-center text-white mt-2">VeMotto Admin</h3>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="index.php?controller=promotion&action=index">
                <i class="c-sidebar-nav-icon cil-bullhorn"></i> Manage Promotions
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="index.php?controller=business&action=index">
                <i class="c-sidebar-nav-icon cil-briefcase"></i> Manage Business
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="index.php?controller=category&action=index">
                <i class="c-sidebar-nav-icon cil-list"></i> Categories
            </a>
        </li>
    </ul>
</div>

<!-- Main wrapper -->
<div class="c-wrapper c-fixed-components">

    <!-- Header -->
    <header class="c-header c-header-light c-header-fixed">
        <button class="c-header-toggler c-class-toggler d-lg-none me-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <i class="cil-menu"></i>
        </button>
        <h4 class="ms-3">VeMotto Admin Panel</h4>
    </header>

    <!-- Body -->
    <div class="c-body">
        <main class="c-main p-4">
            <!-- Main content goes here -->

            </main>
    </div> <!-- /.c-body -->

</div> <!-- /.c-wrapper -->

<!-- CoreUI JS -->
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/js/coreui.bundle.min.js" integrity="sha384-Zb6G3wQH/4+7xFfVYpFFy56x+L2qFNU6GqzYFv3og5pG8Yk0Pgn2B5M1H0O5U9nR" crossorigin="anonymous"></script>

<!-- Optional: jQuery for custom scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.5/dist/jquery.min.js"></script>

<!-- Optional: Your Custom JS -->
<script src="public/assets/js/custom.js"></script>

</body>
</html>
