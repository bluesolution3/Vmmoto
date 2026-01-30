<!DOCTYPE html>
<html>
<head>
    <title>Category Import Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 col-md-7">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            Import Completed
        </div>
        <div class="card-body">
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <strong>Total Rows:</strong> <?= $summary['total_rows'] ?>
                </li>
                <li class="list-group-item text-success">
                    <strong>Inserted:</strong> <?= $summary['inserted'] ?>
                </li>
                <li class="list-group-item text-warning">
                    <strong>Skipped:</strong> <?= $summary['skipped'] ?>
                </li>
                <li class="list-group-item">
                    <strong>Execution Time:</strong> <?= $summary['execution_time'] ?> seconds
                </li>
            </ul>

            <?php if (!empty($summary['errors'])): ?>
                <div class="alert alert-danger">
                    <?= implode('<br>', $summary['errors']) ?>
                </div>
            <?php endif; ?>

            <a href="index.php?controller=categoryImport"
               class="btn btn-primary">
                Import Another File
            </a>
        </div>
    </div>
</div>

</body>
</html>
