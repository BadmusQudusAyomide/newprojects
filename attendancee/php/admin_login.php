<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$admin_username = $_POST['username'];
$admin_password = $_POST['password'];

$sql = "SELECT * FROM admins WHERE username='$admin_username' AND password='$admin_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful";
    // Start session and set admin session variables here
    session_start();
    $_SESSION['admin'] = $admin_username;
    header("Location: ../admin/dashboard.html");
} else {
    echo "Invalid credentials";
}

$conn->close();
?>
