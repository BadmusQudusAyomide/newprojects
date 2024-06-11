<?php
include 'db.php';

function searchUsers($query)
{
    global $conn;
    $query = "%{$query}%";
    $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ?");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function searchPosts($query)
{
    global $conn;
    $query = "%{$query}%";
    $stmt = $conn->prepare("SELECT * FROM posts WHERE content LIKE ?");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>