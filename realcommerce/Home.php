<?php
$pageTitle = "Home";
include 'includes/header.php';

// Sample featured products for the landing page
$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");
$stmt->execute();
$featuredProducts = $stmt->fetchAll();
?>

<main>
    <section class="hero">
        <div class="hero-content">
            <h2>Welcome to My E-commerce Site</h2>
            <p>Discover the best products at unbeatable prices.</p>
            <a href="products.php" class="btn">Shop Now</a>
        </div>
    </section>

    <section class="featured-products">
        <h3>Featured Products</h3>
        <div class="product-grid">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="product-card">
                    <img src="img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>$<?php echo htmlspecialchars($product['price']); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn">View Product</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="about-us">
        <h3>About Us</h3>
        <p>At My E-commerce Site, we strive to provide the best shopping experience. Learn more about our story and values.</p>
        <a href="about.php" class="btn">Learn More</a>
    </section>
</main>