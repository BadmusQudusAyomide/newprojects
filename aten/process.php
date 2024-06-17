<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

// Establishing the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Decode the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];
$date = date('Y-m-d');

// Insert attendance record into the database
$sql = "INSERT INTO attendance (name, date) VALUES ('$name', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
