<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['content'])) {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];
    $media_url = null;
    $privacy = $_POST['privacy'];

    if (isset($_FILES['post_media']) && $_FILES['post_media']['size'] > 0) {
        $target_dir = "uploads/posts/";
        $target_file = $target_dir . basename($_FILES["post_media"]["name"]);
        move_uploaded_file($_FILES["post_media"]["tmp_name"], $target_file);
        $media_url = $target_file;
    }

    $sql = "INSERT INTO posts (user_id, content, media_url, privacy) VALUES ($user_id, '$content', '$media_url', '$privacy')";
    if ($conn->query($sql) === TRUE) {
        echo "Post created!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>