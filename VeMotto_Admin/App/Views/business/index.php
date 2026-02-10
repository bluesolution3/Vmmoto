<!DOCTYPE html>
<html>
<head>
    <title>Business Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h4>Businesses</h4>
<a href="index.php?controller=business&action=add" class="btn btn-primary mb-3">Add Business</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th><th>Name</th><th>Member</th>
        <th>Category</th><th>Subcategory</th><th>Status</th>
    </tr>

    <?php foreach ($businesses as $b): ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= $b['business_name'] ?></td>
        <td><?= $b['member_name'] ?></td>
        <td><?= $b['category_name'] ?></td>
        <td><?= $b['subcategory_name'] ?></td>
        <td>
            <button class="btn btn-sm <?= $b['status'] ? 'btn-success' : 'btn-secondary' ?>"
                    onclick="toggleStatus(<?= $b['id'] ?>, this)">
                <?= $b['status'] ? 'Active' : 'Inactive' ?>
            </button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<script>
function toggleStatus(id, btn) {
    fetch('index.php?controller=business&action=toggleStatus', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + id
    }).then(() => {
        btn.classList.toggle('btn-success');
        btn.classList.toggle('btn-secondary');
        btn.textContent = btn.textContent === 'Active' ? 'Inactive' : 'Active';
    });
}
</script>

</body>
</html>
