<?php
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$postId = $data['postId'];
$userId = $_SESSION['user_id']; // Assuming you have user_id in session

// Check if already liked
$stmt = $conn->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ?");
$stmt->bind_param("ii", $postId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Already liked']);
    exit();
}

// Like the post
$stmt = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
$stmt->bind_param("ii", $postId, $userId);
$stmt->execute();

// Get new like count
$stmt = $conn->prepare("SELECT COUNT(*) as likes FROM likes WHERE post_id = ?");
stmt->bind_param("i", $postId);
$stmt->execute();
$likes = $stmt->get_result()->fetch_assoc()['likes'];

echo json_encode(['success' => true, 'likes' => $likes]);
?>