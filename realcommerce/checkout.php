<?php
// session_start();
include 'includes/db_connect.php';
  $pageTitle = "Checkout";
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $total = 0;

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();
        $total += $product['price'] * $quantity;
        $product_name = $product['name'];
    }

    $stmt = $conn->prepare("INSERT INTO orders (user_id, total, product_name) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $total, $product_name]);
    $order_id = $conn->lastInsertId();

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$order_id, $product_id, $quantity]);
    }

    $_SESSION['cart'] = [];
    header('Location: thank_you.php');
    

    $_SESSION['order_id'] = $order_id;
    header('Location: thank_you.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styless.css">
</head>
<body>
    <header>
        <h1>Checkout</h1>
    </header>
    <main>
        <form action="checkout.php" method="POST">
            <button type="submit">Place Order</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 My E-commerce Site</p>
    </footer>
</body>
</html>