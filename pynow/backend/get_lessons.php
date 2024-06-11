<?php
include 'config.php';
$sql = "SELECT * FROM lessons";
$result = $conn->query($sql);
$lessons = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $lessons[] = $row;
    }
}
echo json_encode($lessons);
$conn->close();
?>