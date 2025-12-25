<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db.php'; // ✅ Ensures $conn is available

// ===============================
// Handle Delete Action
// ===============================
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $delete_sql = "DELETE FROM email_templates WHERE id = $delete_id";
    if (!$conn->query($delete_sql)) {
        echo "<p style='color:red;'>Error deleting record: " . $conn->error . "</p>";
    } else {
        echo "<p style='color:lightgreen;'>Template deleted successfully.</p>";
    }
}

// ===============================
// Fetch Email Templates
// ===============================
$query = "SELECT * FROM email_templates ORDER BY created_at DESC";
$result = $conn->query($query);

// ✅ Check for SQL or table errors
if (!$result) {
    die("<p style='color:red;'>SQL Error: " . $conn->error . "</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Notification Templates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #111;
            color: #fff;
            padding: 30px;
        }
        h2 {
            color: #fff;
            margin-bottom: 10px;
        }
        .add-btn {
            background: #0084ff;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .add-btn:hover {
            background: #006ad4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #1c1c1c;
            margin-top: 20px;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #333;
        }
        th {
            background: #222;
        }
        a {
            color: #00b7ff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .success {
            color: lightgreen;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2>Manage Email Notification Templates</h2>

<a href="template_form.php" class="add-btn">+ New Template</a>

<?php
// If no templates exist
if ($result->num_rows == 0) {
    echo "<p style='margin-top:15px;'>No templates found. Click <b>+ New Template</b> to add one.</p>";
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Subject</th>
        <th>Type</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= htmlspecialchars($row['type']) ?></td>
            <td><?= htmlspecialchars($row['created_at']) ?></td>
            <td>
                <a href="template_form.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="?delete_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this template?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
