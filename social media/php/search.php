<?php
include 'db.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $sql = "SELECT * FROM users WHERE username LIKE '%$query%' OR email LIKE '%$query%'";
    $result = $conn->query($sql);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode($users);
}

$conn->close();
?>