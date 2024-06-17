<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include '../includes/db_connect.php';

$admin_id = $_SESSION['admin_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Handle profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
        $fileName = $_FILES['profile_pic']['name'];
        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = '../img/profile_pics/';
        $dest_path = $uploadFileDir . $newFileName;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profile_pic = $newFileName;

                // Update database with new profile picture
                $stmt = $conn->prepare("UPDATE admins SET profile_pic = ? WHERE id = ?");
                $stmt->execute([$profile_pic, $admin_id]);
            } else {
                $error_message = "There was an error moving the uploaded file.";
            }
        } else {
            $error_message = "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
        }
    }

    $stmt = $conn->prepare("UPDATE admins SET username = ?, email = ? WHERE id = ?");
    $stmt->execute([$username, $email, $admin_id]);

    $_SESSION['username'] = $username;
    $success_message = "Profile updated successfully!";
}

$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch();

$pageTitle = "Admin Profile";
// include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styless.css">
</head>

<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="manage_products.php">Manage Products</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="admin_add_admin.php">Add New Admin</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

<main>
    <section class="profile-section">
        <h2>Admin Profile</h2>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="profile.php" enctype="multipart/form-data">
            <div class="profile-pic">
                <img src="../img/profile_pics/<?php echo htmlspecialchars($admin['profile_pic']); ?>" alt="Profile Picture">
                <input type="file" name="profile_pic">
            </div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
            <button type="submit">Update Profile</button>
        </form>
    </section>
</main>
