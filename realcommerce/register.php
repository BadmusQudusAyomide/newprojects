<?php
include 'includes/db_connect.php';
// include 'includes/pre_login_header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="loginstyle.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>Signup Form</header>
            <form action="register.php" method="POST">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" name="username" id="username" required placeholder="Username">
                </div>
                <div class="field space">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="email" name="email" id="email" required placeholder="Email">
                </div>
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="password" id="password" class="pass-key" required
                        placeholder="Password">
                    <span class="show">SHOW</span>
                </div>
                <!-- <div class="pass">
                    <a href="#">Forgot Password?</a>
                </div> -->
                <br>
                <div class="field">
                    <input type="submit" value="REGISTER">
                    <?php if (isset($error)): ?>
                        <p>
                            <?php echo $error; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </form>
            <div class="login">Or Get Started with</div>
            <div class="links">
                <div class="facebook">
                    <i class="fab fa-google"><span>Google</span></i>
                </div>
                <div class="instagram">
                    <i class="fab fa-facebook-f"><span>Facebook</span></i>
                </div>
            </div>
            <div class="signup">Already have an account?
                <a href="login.php">Login Now</a>
            </div>
        </div>
    </div>

    <script>
        const pass_field = document.querySelector('.pass-key');
        const showBtn = document.querySelector('.show');
        showBtn.addEventListener('click', function () {
            if (pass_field.type === "password") {
                pass_field.type = "text";
                showBtn.textContent = "HIDE";
                showBtn.style.color = "#3498db";
            } else {
                pass_field.type = "password";
                showBtn.textContent = "SHOW";
                showBtn.style.color = "#222";
            }
        });
    </script>
<script src="js/script.js"></script>

</body>

</html>