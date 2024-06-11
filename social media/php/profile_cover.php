<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_FILES['cover_photo'])) {
    $user_id = $_SESSION['user_id'];
    $cover_photo = $_FILES['cover_photo'];

    $target_dir = "uploads/cover_photos/";
    $target_file = $target_dir . basename($cover_photo["name"]);
    move_uploaded_file($cover_photo["tmp_name"], $target_file);

    $sql = "UPDATE users SET cover_photo='$target_file' WHERE id=$user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Cover photo updated!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>