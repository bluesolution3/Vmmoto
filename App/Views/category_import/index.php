<!DOCTYPE html>
<html>
<head>
    <title>Category Import</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Import Categories & Subcategories</h5>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="index.php?controller=categoryImport&action=upload"
                  enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Upload CSV / Excel File</label>
                    <input type="file" name="import_file" class="form-control" required>
                </div>

                <button class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
