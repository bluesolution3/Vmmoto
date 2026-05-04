<form method="POST">

    <div class="mb-3">
        <label class="form-label">OTP Code</label>
        <input type="text" name="otp" maxlength="6" class="form-control text-center" placeholder="Enter 6-digit OTP" required>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-info text-white btn-theme">Verify OTP</button>
    </div>

    <div class="text-center">
        <a href="index.php?page=forgot" class="small-link">Resend OTP</a>
    </div>

</form>
