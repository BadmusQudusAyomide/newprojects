<?php
include 'includes/db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT cart.*, products.name, products.price, products.image FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Cart</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main class="cart-container">
        <h1>Your Cart</h1>
        <div class="cart-items">
            <?php if (count($cart_items) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                            <tr>
                                <td>
                                    <img src="img/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                    <span><?php echo $item['name']; ?></span>
                                </td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>$<?php echo $item['price']; ?></td>
                                <td>$<?php echo $item['price'] * $item['quantity']; ?></td>
                                <td>
                                    <a href="cart.php?action=remove&id=<?php echo $item['id']; ?>" class="btn">Remove</a>
                                </td>
                            </tr>
                            <?php $total_price += $item['price'] * $item['quantity']; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="cart-total">
                    <h2>Total: $<?php echo $total_price; ?></h2>
                    <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
                </div>
            <?php else: ?>
                <p>Your cart is empty. <a href="index.php">Continue shopping</a></p>
            <?php endif; ?>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>