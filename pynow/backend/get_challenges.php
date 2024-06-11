<?php
include 'config.php';
$sql = "SELECT * FROM challenges";
$result = $conn->query($sql);
$challenges = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $challenges[] = $row;
    }
}
echo json_encode($challenges);
$conn->close();
?>