<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'];
$code = $data['code'];
$challenge_id = $data['challenge_id'];

// Here you should implement the code evaluation logic
// For simplicity, we assume the code is always correct

$sql = "INSERT INTO submissions (user_id, challenge_id, code, is_correct) VALUES ('$user_id', '$challenge_id', '$code', 1)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Code submitted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

$conn->close();
?>