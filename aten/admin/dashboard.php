<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch attendance records
$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function printAttendance() {
            var printContents = document.getElementById('attendanceTable').outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="logout.php">Logout</a>
    <h3>Attendance Records</h3>
    <button onclick="printAttendance()">Print Attendance</button>
    <table id="attendanceTable">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["date"] . "</td>
                        <td><a href='delete_attendance.php?id=" . $row["id"] . "'>Delete</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>
    <h3>Add Attendance Record</h3>
    <form action="add_attendance.php" method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="date" name="date" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>
