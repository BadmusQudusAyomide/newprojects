
<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
session_start();
redirectIfNotAdmin();

$product_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];

    if ($image) {
        $target = "../img/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $product['image'];
    }

    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, category_id = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $category_id, $image, $product_id]);
    echo "Product updated successfully";
    header('Location: manage_products.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form action="edit_product.php?id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo $product['description']; ?></textarea><br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php echo $product['price']; ?>" required><br>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php
            $stmt = $conn->prepare("SELECT * FROM categories");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach ($categories as $category) {
                $selected = $category['id'] == $product['category_id'] ? 'selected' : '';
                echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
            }
            ?>
        </select><br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>