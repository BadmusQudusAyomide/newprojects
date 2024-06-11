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
    <title><?php echo $product['name']; ?></title>
</head>

<body>
    <div class="row">
        <div class="col-2">
            <div class="items">
                <div class="item active">
                    <img src="./imgs/watch-1.jpg" alt="" />
                </div>
                <div class="item">
                    <img src="./imgs/watch-2.jpg" alt="" />
                </div>
                <div class="item">
                    <img src="./imgs/watch-3.jpg" alt="" />
                </div>
            </div>
        </div>
        <div class="col-10">
            <div class="carousel">
                <button id="prevBtn"><i class="fas fa-angle-left"></i></button>
                <button id="nextBtn"><i class="fas fa-angle-right"></i></button>
                <div class="slides-container">
                    <div class="slide">
                        <img src="./imgs/watch-1.jpg" alt="" />
                    </div>
                    <div class="slide">
                        <img src="./imgs/watch-2.jpg" alt="" />
                    </div>
                    <div class="slide">
                        <img src="./imgs/watch-3.jpg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>