<!DOCTYPE html>
<html>
<head>
    <title>Manage Customer Phones</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #eef1f5;
            padding: 30px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            max-width: 1200px;
            margin: auto;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .toolbar form {
            display: flex;
            gap: 10px;
        }

        input, select, button {
            padding: 10px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button, .btn {
            background: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-green { background: #28a745; }
        .btn-red { background: #dc3545; }
        .btn-gray { background: #6c757d; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #e6e6e6;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #f8f9fb;
            color: #555;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .active { background: #e6f4ea; color: #2e7d32; }
        .inactive { background: #fdecea; color: #c62828; }
        .verified { background: #e3f2fd; color: #1565c0; }

        .actions a {
            margin-right: 6px;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>
<div class="card">
    <h2>Manage Customer Phones</h2>

    <div class="toolbar">
        <form method="GET">
            <input type="text" name="search" placeholder="Search phone..." value="<?= $_GET['search'] ?? '' ?>">
            <button type="submit">Search</button>
        </form>

        <a href="index.php?action=add" class="btn btn-green">+ Add Phone</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Phone</th>
            <th>Country</th>
            <th>Status</th>
            <th>Verified</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($phones as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['phone_number']) ?></td>
                <td><?= htmlspecialchars($p['country_code']) ?></td>
                <td>
                    <span class="badge <?= $p['status'] ?>">
                        <?= ucfirst($p['status']) ?>
                    </span>
                </td>
                <td>
                    <?= $p['is_verified'] ? '<span class="badge verified">Yes</span>' : 'No' ?>
                </td>
                <td class="actions">
                    <a class="btn btn-gray" href="?action=edit&id=<?= $p['id'] ?>">Edit</a>

                    <a class="btn btn-red"
                       href="?action=status&id=<?= $p['id'] ?>&status=<?= $p['status']=='active'?'inactive':'active' ?>">
                        <?= $p['status']=='active'?'Deactivate':'Activate' ?>
                    </a>

                    <?php if (!$p['is_verified']): ?>
                        <a class="btn btn-green" href="?action=verify&id=<?= $p['id'] ?>">Verify</a>
                    <?php endif; ?>

                    <a class="btn btn-gray"
                       href="?action=delete&id=<?= $p['id'] ?>"
                       onclick="return confirm('Archive this phone?')">
                        Archive
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
