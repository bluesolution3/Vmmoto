<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Send New SMS</h5>
    </div>

    <div class="card-body">

        <form method="POST" action="index.php?controller=promotion&action=store">

            <div class="mb-3">
                <label class="form-label">Select Business</label>
                <select name="business_id" class="form-select" required>
                    <?php foreach ($businesses as $business): ?>
                        <option value="<?= $business['id'] ?>">
                            <?= $business['business_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Message (Max 320 Characters)
                </label>

                <textarea name="message" 
                          id="messageBox"
                          class="form-control"
                          maxlength="320"
                          rows="5"
                          required></textarea>

                <small class="text-muted">
                    <span id="charCount">0</span>/320 characters
                </small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="index.php?controller=promotion&action=index" 
                   class="btn btn-secondary">
                    Back
                </a>

                <button type="submit" class="btn btn-success">
                    Send SMS
                </button>
            </div>

        </form>

    </div>
</div>

<script>
const textarea = document.getElementById('messageBox');
const counter = document.getElementById('charCount');

textarea.addEventListener('input', function() {
    counter.textContent = this.value.length;
});
</script>
