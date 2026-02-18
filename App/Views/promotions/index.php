<!DOCTYPE html>
<html>
<head>
    <title>Manage Promotions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h4>Manage Promotions</h4>

<form method="get">
    <input type="hidden" name="controller" value="promotion">
    <input type="hidden" name="action" value="index">

    <select name="business_id" class="form-select w-50 d-inline" required>
        <option value="">Select Business</option>
        <?php foreach ($businesses as $b): ?>
            <option value="<?= $b['id'] ?>"
                <?= ($selectedBusiness == $b['id']) ? 'selected' : '' ?>>
                <?= $b['business_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="btn btn-primary">View</button>
</form>

<?php if ($selectedBusiness): ?>
    <a href="index.php?controller=promotion&action=send&business_id=<?= $selectedBusiness ?>"
       class="btn btn-success mt-3">Send New Promotion</a>

    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Total</th>
            <th>Success</th>
            <th>Failure</th>
            <th>Date</th>
        </tr>

        <?php foreach ($promotions as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['message'] ?></td>
                <td><?= $p['total_recipients'] ?></td>
                <td><?= $p['success_count'] ?></td>
                <td><?= $p['failure_count'] ?></td>
                <td><?= $p['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
