<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exchange_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT taps FROM tap_counter";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['taps'];
} else {
    echo "0";
}
$conn->close();
?>