<?php
$pageTitle = $pageTitle ?? 'Admin Panel';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= $pageTitle ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
    font-family:Arial, sans-serif;
}

.auth-wrapper{
    min-height:100vh;
}

.auth-box{
    max-width:420px;
    width:100%;
}

.auth-card{
    border:none;
    border-radius:14px;
}

.logo{
    font-size:28px;
    font-weight:700;
    color:#0d6efd;
}

.form-control{
    height:48px;
}

.btn-theme{
    height:48px;
    border-radius:8px;
}

.small-link{
    text-decoration:none;
}

.small-link:hover{
    text-decoration:underline;
}
</style>

</head>

<body>

<div class="container auth-wrapper d-flex justify-content-center align-items-center">

<div class="auth-box">

<div class="card auth-card shadow p-4">

<div class="text-center mb-4">
<div class="logo">Admin Panel</div>
<small class="text-muted"><?= $pageTitle ?></small>
</div>

<?php include $viewFile; ?>

</div>

</div>

</div>

</body>
</html>
