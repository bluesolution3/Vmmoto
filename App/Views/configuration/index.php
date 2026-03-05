<?php
$activeTab = $_GET['tab'] ?? 'portal';
?>

<?php if (isset($_GET['success'])): ?>
<div class="alert alert-success">
    Settings saved successfully.
</div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4>System Configuration</h4>
    </div>

    <div class="card-body">

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link <?= ($activeTab == 'portal') ? 'active' : '' ?>"
                   href="index.php?controller=configuration&action=index&tab=portal">
                    Portal
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($activeTab == 'payment') ? 'active' : '' ?>"
                   href="index.php?controller=configuration&action=index&tab=payment">
                    Payment
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($activeTab == 'twilio') ? 'active' : '' ?>"
                   href="index.php?controller=configuration&action=index&tab=twilio">
                    Twilio
                </a>
            </li>
        </ul>

        <!-- TAB CONTENT -->

        <?php if ($activeTab == 'portal'): ?>
            <form method="POST" action="index.php?controller=configuration&action=savePortal">
                <div class="mb-3">
                    <label>Site Name</label>
                    <input type="text" name="site_name" class="form-control"
                           value="<?= $portal['site_name'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Admin Email</label>
                    <input type="email" name="admin_email" class="form-control"
                           value="<?= $portal['admin_email'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Timezone</label>
                    <input type="text" name="timezone" class="form-control"
                           value="<?= $portal['timezone'] ?? '' ?>">
                </div>

                <button class="btn btn-primary">Save Portal</button>
            </form>
        <?php endif; ?>


        <?php if ($activeTab == 'payment'): ?>
            <form method="POST" action="index.php?controller=configuration&action=savePayment">
                <div class="mb-3">
                    <label>Gateway</label>
                    <input type="text" name="gateway" class="form-control"
                           value="<?= $payment['gateway'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>API Key</label>
                    <input type="text" name="api_key" class="form-control"
                           value="<?= $payment['api_key'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Currency</label>
                    <input type="text" name="currency" class="form-control"
                           value="<?= $payment['currency'] ?? '' ?>">
                </div>

                <button class="btn btn-success">Save Payment</button>
            </form>
        <?php endif; ?>


        <?php if ($activeTab == 'twilio'): ?>
            <form method="POST" action="index.php?controller=configuration&action=saveTwilio">
                <div class="mb-3">
                    <label>Account SID</label>
                    <input type="text" name="account_sid" class="form-control"
                           value="<?= $twilio['account_sid'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Auth Token</label>
                    <input type="text" name="auth_token" class="form-control"
                           value="<?= $twilio['auth_token'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>From Number</label>
                    <input type="text" name="from_number" class="form-control"
                           value="<?= $twilio['from_number'] ?? '' ?>">
                </div>

                <button class="btn btn-dark">Save Twilio</button>
            </form>
        <?php endif; ?>

    </div>
</div>
