<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$student_id = $data['student_id'];
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO attendance (student_id, date) VALUES ('$student_id', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "Attendance recorded successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
