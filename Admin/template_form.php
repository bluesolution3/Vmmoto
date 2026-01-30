<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db.php'; // ✅ fixes connection error

// Fetch existing data if editing
$template = ['name'=>'','subject'=>'','body'=>'','type'=>'membership_signup'];
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $res = $conn->query("SELECT * FROM email_templates WHERE id=$id");
    if ($res->num_rows > 0) {
        $template = $res->fetch_assoc();
    }
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ✅ Check if POST fields exist before using them
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $body = isset($_POST['body']) ? $_POST['body'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : 'membership_signup';

    if ($name && $subject && $body) {
        if (isset($_GET['id'])) {
            // update existing
            $conn->query("UPDATE email_templates SET name='$name', subject='$subject', body='$body', type='$type' WHERE id=$id");
        } else {
            // add new
            $conn->query("INSERT INTO email_templates (name, subject, body, type) VALUES ('$name','$subject','$body','$type')");
        }
        header("Location: email_templates.php");
        exit;
    } else {
        echo "<p style='color:red;'>Please fill all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Template Form</title>
    <style>
        body { font-family: Arial; background: #111; color: white; padding: 20px; }
        input, textarea, select { width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #333; background: #222; color: white; }
        button { padding: 8px 16px; background: #00aaff; border: none; color: white; cursor: pointer; }
        button:hover { background: #0084ff; }
        a { color: #00b7ff; text-decoration: none; }
    </style>
</head>
<body>

<h2><?= isset($_GET['id']) ? 'Edit' : 'Add New' ?> Email Template</h2>

<form method="POST">
    <label>Template Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($template['name']) ?>">

    <label>Subject:</label>
    <input type="text" name="subject" value="<?= htmlspecialchars($template['subject']) ?>">

    <label>Body:</label>
    <textarea name="body" rows="6"><?= htmlspecialchars($template['body']) ?></textarea>

    <label>Type:</label>
    <select name="type">
        <option value="membership_signup" <?= $template['type']=='membership_signup'?'selected':'' ?>>Membership Signup</option>
        <option value="membership_renewal" <?= $template['type']=='membership_renewal'?'selected':'' ?>>Membership Renewal</option>
    </select>

    <button type="submit">Save Template</button>
</form>

<p><a href="email_templates.php">← Back to Templates</a></p>

</body>
</html>
