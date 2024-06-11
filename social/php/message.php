<?php
include 'db.php';

function sendMessage($senderId, $receiverId, $content) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $senderId, $receiverId, $content);
    return $stmt->execute();
}

function getMessages($userId, $friendId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY created_at ASC");
    $stmt->bind_param("iiii", $userId, $friendId, $friendId, $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>