<?php
include 'db.php';

function getPosts() {
    global $conn;
    $stmt = $conn->query("SELECT p.*, (SELECT COUNT(*) FROM likes l WHERE l.post_id = p.id) as likes FROM posts p ORDER BY created_at DESC");
    return $stmt->fetch_all(MYSQLI_ASSOC);
}

function getComments($postId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>