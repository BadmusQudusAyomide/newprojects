<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['request_id'])) {
    $user_id = $_SESSION['user_id'];
    $request_id = $_POST['request_id'];

    $sql = "UPDATE friend_requests SET status='accepted' WHERE id=$request_id";
    if ($conn->query($sql) === TRUE) {
        $friend_sql = "INSERT INTO friends (user_id, friend_id) VALUES ($user_id, $friend_id), ($friend_id, $user_id)";
        $conn->query($friend_sql);
        echo "Friend request accepted!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>