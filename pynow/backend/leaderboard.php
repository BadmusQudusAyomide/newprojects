<?php
include 'config.php';

$sql = "SELECT users.name, COUNT(submissions.id) as score
        FROM users
        JOIN submissions ON users.id = submissions.user_id
        WHERE submissions.is_correct = 1
        GROUP BY users.id
        ORDER BY score DESC
        LIMIT 10";

$result = $conn->query($sql);
$leaderboard = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
}

echo json_encode($leaderboard);

$conn->close();
?>
