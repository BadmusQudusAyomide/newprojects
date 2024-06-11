<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['post_id']) && isset($_POST['comment'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (user_id, post_id, comment) VALUES ($user_id, $post_id, '$comment')";
    if ($conn->query($sql) === TRUE) {
        echo "Comment added!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>