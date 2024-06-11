<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_GET['action'] == 'add') {
    $product_id = $_GET['id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header('Location: cart.php');
}

if ($_GET['action'] == 'remove') {
    $product_id = $_GET['id'];
    unset($_SESSION['cart'][$product_id]);
    header('Location: cart.php');
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Shopping Cart</h1>
    </header>
    <main>
        <div class="cart">
            <?php if (count($_SESSION['cart']) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $product_id => $quantity): ?>
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
                            $stmt->execute([$product_id]);
                            $product = $stmt->fetch();
                            $subtotal = $product['price'] * $quantity;
                            $total += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td>$<?php echo $product['price']; ?></td>
                                <td>$<?php echo $subtotal; ?></td>
                                <td><a href="cart.php?action=remove&id=<?php echo $product_id; ?>">Remove</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h3>Total: $<?php echo $total; ?></h3>
                <a href="checkout.php">Proceed to Checkout</a>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 My E-commerce Site</p>
    </footer>
</body>
</html>
