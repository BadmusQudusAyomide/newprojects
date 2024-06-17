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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <title><?php echo htmlspecialchars($product['name']); ?></title>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="container product-detail">
        <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
        <div class="row">
            <div class="col-10">
                <div class="carousel">
                    <button id="prevBtn"><i class="fas fa-angle-left"></i></button>
                    <button id="nextBtn"><i class="fas fa-angle-right"></i></button>
                    <div class="slides-container">
                        <div class="slide">
                            <img src="img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <?php if (!empty($product['image1'])): ?>
                        <div class="slide">
                            <img src="img/<?php echo htmlspecialchars($product['image1']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($product['image2'])): ?>
                        <div class="slide">
                            <img src="img/<?php echo htmlspecialchars($product['image2']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="items">
                    <div class="item active">
                        <img src="img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <?php if (!empty($product['image1'])): ?>
                    <div class="item">
                        <img src="img/<?php echo htmlspecialchars($product['image1']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($product['image2'])): ?>
                    <div class="item">
                        <img src="img/<?php echo htmlspecialchars($product['image2']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="product-info">
            <p class="product-price"><strong>Price: </strong>#<?php echo htmlspecialchars($product['price']); ?></p>
            <form action="cart.php?action=add&id=<?php echo $product['id']; ?>" method="POST" class="product-form">
                <label for="quantity"><strong>Quantity:</strong></label>
                <input type="number" name="quantity" id="quantity" value="1" min="1">
                <button class="add_to_cart" type="submit">Add to Cart</button>
            </form>
            <div class="product-description">
                <h3>Product Description:</h3>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <h4>Features:</h4>
                <ul>
                    <?php for ($i = 0; $i <= 8; $i++): ?>
                    <?php if (!empty($product['features' . $i])): ?>
                    <li><?php echo htmlspecialchars($product['features' . $i]); ?></li>
                    <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
  
    <script src="script.js"></script>
</body>

</html>