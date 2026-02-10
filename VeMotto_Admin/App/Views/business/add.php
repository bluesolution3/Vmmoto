<!DOCTYPE html>
<html>
<head>
    <title>Add Business</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Add Business</h5>
        </div>

        <div class="card-body">

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="business_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Member</label>
                    <select name="member_id" class="form-select" required>
                        <option value="">-- Select Member --</option>
                        <?php foreach ($members as $member): ?>
                            <option value="<?= $member['id'] ?>">
                                <?= htmlspecialchars($member['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subcategory</label>
                    <select name="subcategory_id" id="subcategory" class="form-select" required>
                        <option value="">-- Select Subcategory --</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Business
                </button>

            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('category').addEventListener('change', function () {
    const categoryId = this.value;
    const subcategorySelect = document.getElementById('subcategory');

    subcategorySelect.innerHTML = '<option value="">Loading...</option>';

    fetch(`index.php?controller=business&action=getSubcategories&category_id=${categoryId}`)
        .then(res => res.json())
        .then(data => {
            subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
            data.forEach(row => {
                const opt = document.createElement('option');
                opt.value = row.id;
                opt.textContent = row.name;
                subcategorySelect.appendChild(opt);
            });
        });
});
</script>

</body>
</html>
