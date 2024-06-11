<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['auth_code'])) {
    $user_id = $_SESSION['user_id'];
    $auth_code = $_POST['auth_code'];

    $sql = "SELECT * FROM users WHERE id = $user_id AND auth_code = '$auth_code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Authentication successful!";
    } else {
        echo "Invalid authentication code.";
    }
}

$conn->close();
?>
