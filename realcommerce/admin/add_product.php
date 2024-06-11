
<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
session_start();
redirectIfNotAdmin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $target = "../img/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $category_id, $image]);
        echo "Product added successfully";
    } else {
        echo "Failed to upload image";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required><br>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php
            $stmt = $conn->prepare("SELECT * FROM categories");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select><br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br>
        <button type="submit">Add Product</button>
    </form>
    <?php if ($message): ?>
        <p>
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
</body>
</html>
