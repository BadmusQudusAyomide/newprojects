<?php
include 'db.php';

function createNotification($userId, $type, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifications (user_id, type, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $type, $message);
    return $stmt->execute();
}

function getNotifications($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>