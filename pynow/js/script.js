document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const authSection = document.getElementById('auth-section');

    loginBtn.addEventListener('click', () => {
        authSection.style.display = 'block';
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    });

    registerBtn.addEventListener('click', () => {
        authSection.style.display = 'block';
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    });

    document.getElementById('register').addEventListener('submit', async (e) => {
        e.preventDefault();

        const name = document.getElementById('register-name').value;
        const email = document.getElementById('register-email').value;
        const password = document.getElementById('register-password').value;

        try {
            const response = await fetch('backend/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name, email, password })
            });

            const result = await response.json();
            alert(result.message);
            if (result.status === 'success') {
                authSection.style.display = 'none';
                window.location.href = 'lesson.html';
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    document.getElementById('login').addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;

        try {
            const response = await fetch('backend/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });

            const result = await response.json();
            alert(result.message);
            if (result.status === 'success') {
                authSection.style.display = 'none';
                window.location.href = 'lesson.html';
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });



//  const loadLessons = async () => {
//         const response = await fetch('backend/get_lessons.php');
//         const lessons = await response.json();
//         const lessonContent = document.getElementById('lesson-content');
//         lessonContent.innerHTML = lessons.map(lesson => `<div class="lesson">${lesson.content}</div>`).join('');
    //     };
    
const loadLessons = async () => {
    const response = await fetch('backend/get_lessons.php');
    const lessons = await response.json();
    const lessonContent = document.getElementById('lesson-content');
    lessonContent.innerHTML = lessons.map(lesson => `
        <div class="lesson">
            <h2>${lesson.title}</h2>
            <p>${lesson.content}</p>
        </div>
    `).join('');
};
if (document.getElementById('lesson-content')) loadLessons();
    // Load quizzes
    const loadQuizzes = async () => {
        const response = await fetch('backend/get_quizzes.php');
        const quizzes = await response.json();
        const quizContent = document.getElementById('quiz-content');
        quizContent.innerHTML = quizzes.map((quiz, index) => `
            <div class="quiz">
                <p>${index + 1}. ${quiz.question}</p>
                <label><input type="radio" name="quiz${index}" value="1"> ${quiz.option1}</label>
                <label><input type="radio" name="quiz${index}" value="2"> ${quiz.option2}</label>
                <label><input type="radio" name="quiz${index}" value="3"> ${quiz.option3}</label>
                <label><input type="radio" name="quiz${index}" value="4"> ${quiz.option4}</label>
            </div>
        `).join('');
    };

    // Load coding challenges
    // const loadChallenges = async () => {
    //     const response = await fetch('backend/get_challenges.php');
    //     const challenges = await response.json();
    //     const challengeContent = document.getElementById('challenge-content');
    //     challengeContent.innerHTML = challenges.map(challenge => `<div class="challenge">${challenge.content}</div>`).join('');
    // };
const loadChallenges = async () => {
    const response = await fetch('backend/get_challenges.php');
    const challenges = await response.json();
    const challengeContent = document.getElementById('challenge-content');
    challengeContent.innerHTML = challenges.map(challenge => `
        <div class="challenge">
            <h2>${challenge.title}</h2>
            <p>${challenge.description}</p>
        </div>
    `).join('');
};

document.getElementById('submit-code').addEventListener('click', async () => {
    const code = document.getElementById('code-editor').value;
    const userId = /* fetch user ID from session */;
    const challengeId = /* fetch current challenge ID */;
    try {
        const response = await fetch('backend/submit_code.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ user_id: userId, code, challenge_id: challengeId })
        });
        const result = await response.json();
        alert(result.message);
    } catch (error) {
        console.error('Error:', error);
    }
});

if (document.getElementById('challenge-content')) loadChallenges();







    // Load leaderboard
    const loadLeaderboard = async () => {
        const response = await fetch('backend/leaderboard.php');
        const leaderboard = await response.json();
        const leaderboardContent = document.getElementById('leaderboard-content');
        leaderboardContent.innerHTML = leaderboard.map((entry, index) => `<div>${index + 1}. ${entry.name} - ${entry.score}</div>`).join('');
    };

    // Call these functions to load data
    if (document.getElementById('lesson-content')) loadLessons();
    if (document.getElementById('quiz-content')) loadQuizzes();
    if (document.getElementById('challenge-content')) loadChallenges();
if (document.getElementById('leaderboard-content')) loadLeaderboard();
    
});