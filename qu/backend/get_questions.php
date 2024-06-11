<?php
include 'config.php';

$sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 10";
$result = $conn->query($sql);

$questions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

echo json_encode($questions);
$conn->close();
?>
