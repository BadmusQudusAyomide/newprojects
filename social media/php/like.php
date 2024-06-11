<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['post_id'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];

    // Check if user already liked the post
    $check_sql = "SELECT * FROM likes WHERE user_id = $user_id AND post_id = $post_id";
    $result = $conn->query($check_sql);

    if ($result->num_rows == 0) {
        $sql = "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $post_id)";
        if ($conn->query($sql) === TRUE) {
            echo "Post liked!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "You already liked this post.";
    }
}

$conn->close();

