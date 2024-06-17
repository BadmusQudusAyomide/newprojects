<?php
include 'includes/db_connect.php';
// include 'includes/pre_login_header.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'user'");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header('Location: index.php');
  } else {
    $error = "Invalid username or password";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>E-commerce Login</title>
  <link rel="stylesheet" href="loginstyle.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
  <div class="bg-img">
    <div class="content">
      <header>Login Form</header>
      <form action="login.php" method="POST">
        <div class="field">
          <span class="fa fa-user"></span>
          <input type="text" name="username" id="username" required placeholder="Email or Phone">
        </div>
        <div class="field space">
          <span class="fa fa-lock"></span>
          <input type="password" name="password" id="password" class="pass-key" required placeholder="Password">
          <span class="show">SHOW</span>
        </div>
        <div class="pass">
          <a href="#">Forgot Password?</a>
        </div>
        <div class="field">
          <input type="submit" value="LOGIN">
          <?php if (isset($error)): ?>
            <p>
              <?php echo $error; ?>
            </p>
          <?php endif; ?>
        </div>
      </form>
      <div class="login">Or login with</div>
      <div class="links">
        <div class="facebook">
          <i class="fab fa-google"><span>Google</span></i>
        </div>
        <div class="instagram">
          <i class="fab fa-facebook-f"><span>Facebook</span></i>
        </div>
      </div>
      <div class="signup">Don't have account?
        <a href="register.php">Signup Now</a>
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


</body>

</html>