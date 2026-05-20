<?php
$pageTitle = $pageTitle ?? 'VeMotto';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= htmlspecialchars($pageTitle) ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    font-family: Arial,sans-serif;
}

.navbar-brand{
    font-weight:700;
    color:#0d6efd !important;
}

.hero{
    background: linear-gradient(135deg,#0d6efd,#6610f2);
    color:white;
    padding:100px 0;
}

.section{
    padding:80px 0;
}

.footer{
    background:#212529;
    color:white;
    padding:20px 0;
}

.card{
    border:none;
    border-radius:15px;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

@media(max-width:768px){
    .hero{
        padding:60px 0;
        text-align:center;
    }
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
<div class="container">
<a class="navbar-brand" href="index.php?page=home">VeMotto</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link" href="index.php?page=home">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="index.php?page=about">About</a>
</li>
<li class="nav-item">
<a class="nav-link" href="index.php?page=contact">Contact</a>
</li>
</ul>
</div>
</div>
</nav>

<?php include $viewFile; ?>

<footer class="footer text-center">
<div class="container">
© 2026 VeMotto | All Rights Reserved
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
