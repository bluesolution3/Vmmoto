<!DOCTYPE html>
<html>
<head>
    <title>Import Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">File Uploaded Successfully</h5>
                </div>

                <div class="card-body">
                    <div class="alert alert-success">
                        <strong>Success!</strong> Your file has been uploaded and is ready for processing.
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">File Name</th>
                            <td><?= htmlspecialchars($data['file_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Stored Path</th>
                            <td><?= htmlspecialchars($data['stored_path']) ?></td>
                        </tr>
                    </table>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="index.php?controller=categoryImport"
                           class="btn btn-secondary">
                            Upload Another File
                        </a>

                        <button class="btn btn-primary" disabled>
                            Start Import (Next Step)
                        </button>
                    </div>

                    <small class="text-muted d-block mt-3">
                        Next step: Validate and import categories & subcategories.
                    </small>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
