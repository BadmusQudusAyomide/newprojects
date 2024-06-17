<?php
$conn = new mysqli('localhost', 'root', '', 'attendance_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("
    SELECT a.student_id, s.name, a.date 
    FROM attendance_records a 
    JOIN students s 
    ON a.student_id = s.student_id
");

$attendance = [];
while ($row = $result->fetch_assoc()) {
    $attendance[] = $row;
}

echo json_encode($attendance);

$conn->close();
?>
