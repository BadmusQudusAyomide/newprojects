<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exchange_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header('Location: index.html');
} else {
    echo "Invalid username or password";
}

$conn->close();
?>