<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Manage Promotions</h5>
        <a href="index.php?controller=promotion&action=create" 
           class="btn btn-light btn-sm">
            + Send New SMS
        </a>
    </div>

    <div class="card-body">

        <form method="GET" class="row mb-4">
            <input type="hidden" name="controller" value="promotion">
            <input type="hidden" name="action" value="index">

            <div class="col-md-4">
                <select name="business_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Select Business</option>
                    <?php foreach ($businesses as $business): ?>
                        <option value="<?= $business['id'] ?>"
                            <?= ($selectedBusiness == $business['id']) ? 'selected' : '' ?>>
                            <?= $business['business_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Total</th>
                        <th class="text-success">Success</th>
                        <th class="text-danger">Failure</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($promotions)): ?>
                        <?php foreach ($promotions as $promo): ?>
                            <tr>
                                <td><?= $promo['id'] ?></td>
                                <td><?= $promo['message'] ?></td>
                                <td><?= $promo['total_sent'] ?></td>
                                <td class="text-success"><?= $promo['success_count'] ?></td>
                                <td class="text-danger"><?= $promo['failure_count'] ?></td>
                                <td><?= date('d M Y H:i', strtotime($promo['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No promotions sent yet.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
