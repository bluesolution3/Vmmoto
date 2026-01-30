<?php
// db.php — shared connection file
$servername = "localhost";
$username = "root";  // default for XAMPP
$password = "";      // default for XAMPP
$dbname = "vemotto_demo"; // make sure this matches phpMyAdmin DB

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
