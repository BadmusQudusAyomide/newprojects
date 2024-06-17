<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_username = $_POST['username'];
$user_password = $_POST['password'];

$sql = "SELECT * FROM students WHERE student_id='$user_username' AND password='$user_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful";
    // Start session and set student session variables here
    session_start();
    $_SESSION['student'] = $user_username;
    header("Location: ../student/generate_qr.html");
} else {
    echo "Invalid credentials";
}

$conn->close();
?>
