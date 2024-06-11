<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM notifications WHERE user_id = $user_id ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $notifications = [];
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    echo json_encode($notifications);
}

$conn->close();

