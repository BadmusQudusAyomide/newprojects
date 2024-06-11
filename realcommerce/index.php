<?php
include 'includes/db_connect.php';

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My E-commerce Site</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>Welcome to My E-commerce Site</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart (<span id="cart-count">0</span>)</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
            <button id="menu-toggle">☰</button>
        </nav>
    </header>
    <main>
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h2><?php echo $product['name']; ?></h2>
                    <p><?php echo $product['description']; ?></p>
                    <p>$<?php echo $product['price']; ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>">View Product</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 My E-commerce Site</p>
    </footer>
</body>
</html>