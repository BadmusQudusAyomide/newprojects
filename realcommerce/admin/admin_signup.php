<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        $message = "Username or Email already exists.";
    } else {
        // Insert new admin into users table
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
        $stmt->execute([$username, $email, $password]);

        $message = "Admin account created successfully. Please delete this file now.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function validateForm() {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            let message = '';

            if (username === '' || email === '' || password === '' || confirmPassword === '') {
                message = 'All fields are required.';
            } else if (password !== confirmPassword) {
                message = 'Passwords do not match.';
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                message = 'Email is invalid.';
            }

            if (message) {
                document.getElementById('error_message').innerText = message;
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <header>
        <h1>Admin Signup</h1>
    </header>
    <main>
        <form action="admin_signup.php" method="POST" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required><br>
            <button type="submit">Signup</button>
            <p id="error_message" style="color: red;"></p>
            <?php if (isset($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 My E-commerce Site</p>
    </footer>
</body>

</html>