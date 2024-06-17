<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
// include '../includes/header.php';
// session_start();
// redirectIfNotAdmin();

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$orders = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styless.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="manage_products.php">Manage Products</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="admin_add_admin.php">Add New Admin</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
<body>
    <h1>Manage Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Buyers Name</th>
                <th>Order items</th>
                <th>Total</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $users['username']; ?></td>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['total']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>