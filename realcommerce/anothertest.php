<?php
include 'includes/db_connect.php';

$product_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1 class="up"><?php echo $product['name']; ?></h1>
    </header>
    <main>
        <div class="product-detail">
            <img class="propro" src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <h2><?php echo $product['name']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p>$<?php echo $product['price']; ?></p>
            <form action="cart.php?action=add&id=<?php echo $product['id']; ?>" method="POST">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 My E-commerce Site</p>
    </footer>
</body>
</html>
