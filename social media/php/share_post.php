<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['post_id'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];

    $sql = "INSERT INTO shares (user_id, post_id) VALUES ($user_id, $post_id)";
    if ($conn->query($sql) === TRUE) {
        echo "Post shared!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
