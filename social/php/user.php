<?php
include 'db.php';

function getUserProfile($userId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateUserProfile($userId, $bio, $profilePicture, $coverPhoto)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET bio = ?, profile_picture = ?, cover_photo = ? WHERE id = ?");
    $stmt->bind_param("sssi", $bio, $profilePicture, $coverPhoto, $userId);
    return $stmt->execute();
}
?>