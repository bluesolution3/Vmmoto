<!DOCTYPE html>
<html>
<head>
    <title>Send Promotion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h4>Send Promotion</h4>

<?php if (!empty($successMsg)): ?>
    <div class="alert alert-success"><?= $successMsg ?></div>
<?php endif; ?>

<form method="post">

    <div class="mb-3">
        <label>Message (Max 320 characters)</label>
        <textarea name="message" class="form-control" maxlength="320" required></textarea>
        <small id="charCount">0 / 320</small>
    </div>

    <button class="btn btn-primary">Send SMS</button>
</form>

<script>
const textarea = document.querySelector('textarea');
const counter = document.getElementById('charCount');

textarea.addEventListener('input', function () {
    counter.textContent = textarea.value.length + " / 320";
});
</script>

</body>
</html>
