<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_FILES['profile_picture'])) {
    $user_id = $_SESSION['user_id'];
    $profile_picture = $_FILES['profile_picture'];

    $target_dir = "uploads/profile_pictures/";
    $target_file = $target_dir . basename($profile_picture["name"]);
    move_uploaded_file($profile_picture["tmp_name"], $target_file);

    $sql = "UPDATE users SET profile_picture='$target_file' WHERE id=$user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Profile picture updated!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>