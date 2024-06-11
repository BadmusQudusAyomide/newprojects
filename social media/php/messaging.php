<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['receiver_id']) && isset($_POST['message'])) {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($sender_id, $receiver_id, '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message sent!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>