<?php
include 'db.php';

if (isset($_POST['email']) && isset($_POST['token'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];

    $sql = "UPDATE users SET verified = 1 WHERE email = '$email' AND token = '$token'";
    if ($conn->query($sql) === TRUE) {
        echo "Email verified!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
