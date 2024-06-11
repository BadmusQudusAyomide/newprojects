<?php
include 'db.php';
session_start();

header('Content-Type: application/json');

// CSRF token validation
validateCsrfToken();

$data = json_decode(file_get_contents('php://input'), true);

$postId = $data['postId'];
$content = trim($data['content']);
$userId = $_SESSION['user_id'];

if (empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Comment cannot be empty']);
    exit;
}

if (!preg_match('/^[a-zA-Z\s]+$/', $content)) {
    echo json_encode(['success' => false, 'message' => 'Invalid characters in comment']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $postId, $userId, $content);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true, 'comment' => ['content' => htmlspecialchars($content)]]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to submit comment']);
}
?>