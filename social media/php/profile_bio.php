<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['bio'])) {
    $user_id = $_SESSION['user_id'];
    $bio = $_POST['bio'];

    $sql = "UPDATE users SET bio='$bio' WHERE id=$user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Bio updated!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>