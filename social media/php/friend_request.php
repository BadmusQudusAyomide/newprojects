<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['friend_id'])) {
$user_id = $_SESSION['user_id'];
$friend_id = $_POST['friend_id'];

$sql = "INSERT INTO friend_requests (sender_id, receiver_id) VALUES ($user_id, $friend_id)";
if ($conn->query($sql) === TRUE) {
echo "Friend request sent!";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>
