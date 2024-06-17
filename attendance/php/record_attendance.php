<?php
$data = json_decode(file_get_contents('php://input'), true);
$student_id = $data['student_id'];

$conn = new mysqli('localhost', 'root', '', 'attendance_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO attendance_records (student_id) VALUES (?)");
$stmt->bind_param("s", $student_id);

if ($stmt->execute()) {
    echo "Attendance recorded for student ID: $student_id.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
