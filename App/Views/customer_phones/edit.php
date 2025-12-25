<!DOCTYPE html>
<html>
<head>
    <title>Edit Phone</title>
    <style>
        body { font-family: Arial; background:#eef1f5; padding:40px; }
        .card { background:#fff; padding:30px; max-width:500px; margin:auto; border-radius:10px; }
        input, button { width:100%; padding:12px; margin-top:10px; }
        button { background:#28a745; color:#fff; border:none; }
    </style>
</head>
<body>
<div class="card">
    <h3>Edit Customer Phone</h3>
    <form method="post" action="index.php?action=update">
        <input type="hidden" name="id" value="<?= $phone['id'] ?>">
        <input name="phone_number" value="<?= $phone['phone_number'] ?>" required>
        <input name="country_code" value="<?= $phone['country_code'] ?>" required>
        <button>Update Phone</button>
    </form>
</div>
</body>
</html>
