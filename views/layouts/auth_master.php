<?php
$pageTitle = $pageTitle ?? 'Admin Panel';
$subtitle = $subtitle ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .auth-page {
            min-height: 100vh;
        }

        .auth-left {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff;
            padding: 60px;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            border: none;
            border-radius: 18px;
            padding: 32px;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            color: #0d6efd;
        }

        .form-control {
            height: 48px;
            border-radius: 10px;
        }

        .btn-theme {
            height: 48px;
            border-radius: 10px;
            font-weight: 600;
        }

        .small-link {
            text-decoration: none;
            font-size: 14px;
        }

        .small-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 991px) {
            .auth-left {
                display: none;
            }

            .auth-card {
                max-width: 100%;
                padding: 26px;
            }
        }

        @media (max-width: 576px) {
            .auth-wrapper {
                padding: 20px;
            }

            .auth-card {
                padding: 22px;
                box-shadow: none !important;
            }

            .brand-title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="container-fluid auth-page">
    <div class="row min-vh-100">

        <div class="col-lg-6 d-flex align-items-center auth-left">
            <div>
                <h1 class="fw-bold mb-3">Welcome to Admin Panel</h1>
                <p class="fs-5 mb-0">
                    Manage your account securely with a clean and responsive interface.
                </p>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center justify-content-center auth-wrapper">
            <div class="card auth-card shadow-lg">

                <div class="text-center mb-4">
                    <div class="brand-title">Admin Panel</div>
                    <p class="text-muted mb-0"><?= htmlspecialchars($subtitle) ?></p>
                </div>

                <?php include $viewFile; ?>

            </div>
        </div>

    </div>
</div>

</body>
</html>
