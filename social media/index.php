<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media App</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/animations.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Social Media App</h1>
            <nav>
                <ul>
                    <li><a href="#register">Register</a></li>
                    <li><a href="#login">Login</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section id="register">
                <h2>Register</h2>
                <form id="registerForm">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Register</button>
                </form>
            </section>
            <section id="login">
                <h2>Login</h2>
                <form id="loginForm">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </section>
            <section id="posts">
                <!-- Posts will be dynamically loaded here -->
            </section>
            <section id="profile" style="display: none;">
                <!-- Profile info will be dynamically loaded here -->
                 <section id="profile-settings">
    <h2>Profile Settings</h2>
    <form id="profilePictureForm" enctype="multipart/form-data">
        <input type="file" name="profile_picture" required>
        <button type="submit">Upload</button>
    </form>
</section>
            </section>
        </main>
    </div>
    <script src="js/main.js"></script>
</body>

</html>