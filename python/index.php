<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Python Tutorial Learner</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Python Tutorial Learner</h1>
            <nav>
                <button id="login-btn">Login</button>
                <button id="register-btn">Register</button>
            </nav>
        </header>
        <main>
            <section class="auth" id="auth-section">
                <div id="login-form" style="display:none;">
                    <h2>Login</h2>
                    <form id="login">
                        <input type="email" id="login-email" placeholder="Email" required>
                        <input type="password" id="login-password" placeholder="Password" required>
                        <button type="submit">Login</button>
                    </form>
                </div>
                <div id="register-form" style="display:none;">
                    <h2>Register</h2>
                    <form id="register">
                        <input type="text" id="register-name" placeholder="Name" required>
                        <input type="email" id="register-email" placeholder="Email" required>
                        <input type="password" id="register-password" placeholder="Password" required>
                        <button type="submit">Register</button>
                    </form>
                </div>
            </section>
            <section class="lessons" id="lesson-section" style="display:none;">
                <h2>Lessons</h2>
                <ul id="lesson-list">
                    <!-- Lessons will be dynamically loaded here -->
                </ul>
            </section>
            <section class="content">
                <h2 id="lesson-title">Select a Lesson</h2>
                <div id="lesson-content">Lesson content will appear here.</div>
                <button id="start-quiz" style="display: none;">Start Quiz</button>
            </section>
            <section class="quiz" style="display: none;">
                <h2>Quiz</h2>
                <div id="quiz-content">Quiz content will appear here.</div>
                <button id="submit-quiz">Submit Quiz</button>
                <div id="quiz-result"></div>
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>