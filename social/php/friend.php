<?php
include 'db.php';

function sendFriendRequest($userId, $friendId) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO friends (user_id, friend_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $friendId);
    return $stmt->execute();
}

function acceptFriendRequest($userId, $friendId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE friends SET status = 'accepted' WHERE user_id = ? AND friend_id = ?");
    $stmt->bind_param("ii", $userId, $friendId);
    return $stmt->execute();
}

function getFriends($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id IN (SELECT friend_id FROM friends WHERE user_id = ? AND status = 'accepted')");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>