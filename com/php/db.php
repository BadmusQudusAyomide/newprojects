<?php
$conn = new mysqli('localhost', 'root', '', 'database_structure.sql');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>