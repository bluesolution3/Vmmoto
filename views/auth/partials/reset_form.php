<form method="POST">

    <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-success btn-theme">Update Password</button>
    </div>

    <div class="text-center">
        <a href="index.php?page=login" class="small-link">Back to Login</a>
    </div>

</form>
