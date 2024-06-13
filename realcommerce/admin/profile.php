<?php
// session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin/index.php');
    exit;
}

include '../includes/db_connect.php';

$admin_id = $_SESSION['admin_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE admins SET username = ?, email = ? WHERE id = ?");
    $stmt->execute([$username, $email, $admin_id]);

    $_SESSION['username'] = $username;
    $success_message = "Profile updated successfully!";
}

$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
stmt->execute([$admin_id]);
$admin = $stmt->fetch();

$pageTitle = "Admin Profile";
include '../includes/header.php';
?>

<main>
    <section class="profile-section">
        <h2>Admin Profile</h2>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="profile.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
            <button type="submit">Update Profile</button>
        </form>
    </section>
</main>
