<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Customer Phone</title>

    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #eef1f5;
            padding: 40px;
        }

        .card {
            background: #ffffff;
            max-width: 520px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: #0d6efd;
            color: #ffffff;
        }

        .btn-secondary {
            background: #6c757d;
            color: #ffffff;
        }

        .note {
            font-size: 12px;
            color: #777;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Add Customer Phone</h2>

    <form method="POST" action="index.php?action=store">

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input
                type="text"
                id="phone_number"
                name="phone_number"
                placeholder="e.g. 9876543210"
                required
            >
        </div>

        <div class="form-group">
            <label for="country_code">Country Code</label>
            <input
                type="text"
                id="country_code"
                name="country_code"
                placeholder="e.g. +91"
                required
            >
        </div>

        <div class="actions">
            <a href="index.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Add Phone</button>
        </div>

        <div class="note">
            Newly added phone numbers will be inactive and unverified by default.
        </div>
    </form>
</div>

</body>
</html>
