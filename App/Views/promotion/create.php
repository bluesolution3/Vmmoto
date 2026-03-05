<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Send New SMS</h5>
    </div>

    <div class="card-body">

        <form method="POST" action="index.php?controller=promotion&action=send">

            <div class="mb-3">
                <label class="form-label">Select Business</label>
                <select name="business_id" class="form-select" required>
                    <option value="">Select Business</option>
                    <?php foreach ($businesses as $business): ?>
                        <option value="<?= $business['id'] ?>">
                            <?= $business['business_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Message (Max 320 characters)</label>
                <textarea name="message" class="form-control" maxlength="320" rows="4" required></textarea>
                <small class="text-muted">Maximum 320 characters allowed.</small>
            </div>

            <button type="submit" class="btn btn-success">
                Send SMS
            </button>

            <a href="index.php?controller=promotion&action=index" 
               class="btn btn-secondary">
               Cancel
            </a>

        </form>

    </div>
</div>
