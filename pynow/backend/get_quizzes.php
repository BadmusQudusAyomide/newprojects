<?php
include 'config.php';
$sql = "SELECT * FROM quizzes";
$result = $conn->query($sql);
$quizzes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $quizzes[] = $row;
    }
}
echo json_encode($quizzes);
$conn->close();
?>