<?php
include 'includes/db_connect.php';

$product_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();
$pageTitle = $product['name']; // Set the page title
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="css/styless.css">
    <title><?php echo $product['name']; ?></title>
</head>

<body>
    <header>
        <h1 class="up coll">Product Name: <?php echo $product['name']; ?></h1>
      
    </header>
    <div class="product-detail">
     
            
            <div class="col-10">
                <div class="carousel">
                    <button id="prevBtn"><i class="fas fa-angle-left"></i></button>
                    <button id="nextBtn"><i class="fas fa-angle-right"></i></button>
                    <div class="slides-container">
                        <div class="slide">
                            <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        </div>
                        <div class="slide">
                            <img src="img/<?php echo $product['image1']; ?>" alt="<?php echo $product['name']; ?>">
                        </div>
                        <div class="slide">
                            <img src="img/<?php echo $product['image2']; ?>" alt="<?php echo $product['name']; ?>">
                        </div>
                    </div>
                </div>
            </div>
             
        
         <div class="col-2">
                <div class="items">
                    <div class="item active">
                        <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="item">
                        <img src="img/<?php echo $product['image1']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="item">
                        <img src="img/<?php echo $product['image2']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                </div>
            </div><br><br>
    <div class="pro">
        <p><strong>Price: </strong><strong>#<span id="product-price"><?php echo $product['price']; ?></span</strong></p>
        <br>
        <form action="cart.php?action=add&id=<?php echo $product['id']; ?>" method="POST">
            <label for="quantity"><strong>Quantity:</strong></label>
            <input type="number" name="quantity" id="quantity" value="1" min="1">
            <br>
            <button onclick="addToCart(1, 1)" class="add_to_cart" type="submit">Add to Cart</button>
        </form>
<br>
        <!-- <h2><center>Product Name: <?php echo $product['name']; ?></center></h2> -->
        <p><b>Product Description:</b><br>    <?php echo $product['description']; ?></p>
        <h4>Features: </h4>
        <ul>
            <li><?php echo $product['features']; ?></li>
            <li><?php echo $product['features1']; ?></li>
            <li><?php echo $product['features2']; ?></li>
            <li><?php echo $product['features3']; ?></li>
            <li><?php echo $product['features4']; ?></li>
            <li><?php echo $product['features5']; ?></li>
            <li><?php echo $product['features6']; ?></li>
            <li><?php echo $product['features7']; ?></li>
            <li><?php echo $product['features8']; ?></li>
        </ul>
        </div>
    </div>
    </div>
    <footer>
        <p>&copy; 2024 My E-commerce Site</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>