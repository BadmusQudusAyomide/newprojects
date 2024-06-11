<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['order_id'])) {
    header('Location: index.php');
    exit();
}

$order_id = $_SESSION['order_id'];
unset($_SESSION['order_id']);

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch();

$stmt = $conn->prepare("SELECT order_items.*, products.name, products.image, products.price 
                        FROM order_items 
                        JOIN products ON order_items.product_id = products.id 
                        WHERE order_items.order_id = ?");
$stmt->execute([$order_id]);
$order_items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Thank You for Your Purchase!</h1>
    </header>
    <main>
        <p>Your order has been placed successfully. We will notify you once it has been shipped.</p>
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
        <p><strong>Total Amount:</strong> $<?php echo $order['total']; ?></p>
        <p><strong>Date:</strong> <?php echo $order['order_date']; ?></p>
        <h3>Items Ordered</h3>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $item): ?>
                    <tr>
                        <td><img src="img/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" width="50"></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo $item['price']; ?></td>
                        <td>$<?php echo $item['price'] * $item['quantity']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php">Continue Shopping</a>
    </main>
    <footer>
        <p>&copy; 2024 My E-commerce Site</p>
    </footer>
</body>

</html>