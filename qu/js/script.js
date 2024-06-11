document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const authSection = document.getElementById('auth-section');
    const uploadQuestionBtn = document.getElementById('upload-question-btn');
    const uploadQuestionSection = document.getElementById('upload-question-section');
    const uploadQuestionForm = document.getElementById('upload-question-form');
    const quizSection = document.getElementById('quiz-section');
    const quizContent = document.getElementById('quiz-content');
    const timer = document.getElementById('timer');
    const timeDisplay = document.getElementById('time');
    const submitQuizBtn = document.getElementById('submit-quiz');
    const quizResult = document.getElementById('quiz-result');

    let questions = [];
    let timerInterval;
    let timeLeft = 60; // 60 seconds for the quiz

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
                quizSection.style.display = 'block';
                fetchQuestions();
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
                quizSection.style.display = 'block';
                fetchQuestions();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    uploadQuestionBtn.addEventListener('click', () => {
        uploadQuestionSection.style.display = 'block';
    });

    uploadQuestionForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(uploadQuestionForm);
        try {
            const response = await fetch('backend/upload_question.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            alert(result.message);
            if (result.status === 'success') {
                uploadQuestionSection.style.display = 'none';
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    const fetchQuestions = async () => {
        try {
            const response = await fetch('backend/get_questions.php');
            questions = await response.json();
            displayQuestions();
            startTimer();
        } catch (error) {
            console.error('Error:', error);
        }
    };

    const displayQuestions = () => {
        quizContent.innerHTML = '';
        questions.forEach((question, index) => {
            const questionElement = document.createElement('div');
            questionElement.className = 'question';
            questionElement.innerHTML = `
                <p>${index + 1}. ${question.question}</p>
                ${question.image_path ? `<img src="${question.image_path}" alt="Question Image">` : ''}
                <label><input type="radio" name="question${index}" value="option1"> ${question.option1}</label>
                <label><input type="radio" name="question${index}" value="option2"> ${question.option2}</label>
                <label><input type="radio" name="question${index}" value="option3"> ${question.option3}</label>
                <label><input type="radio" name="question${index}" value="option4"> ${question.option4}</label>
            `;
            quizContent.appendChild(questionElement);
        });
    };

    const startTimer = () => {
        timeLeft = 60;
        timeDisplay.textContent = `${timeLeft}s`;
        timerInterval = setInterval(() => {
            timeLeft--;
            timeDisplay.textContent = `${timeLeft}s`;
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                submitQuiz();
            }
        }, 1000);
    };

    const submitQuiz = () => {
        clearInterval(timerInterval);
        let score = 0;
        questions.forEach((question, index) => {
            const selectedOption = document.querySelector(`input[name="question${index}"]:checked`);
            if (selectedOption && selectedOption.value === question.correct_option) {
                score++;
            }
        });
        quizResult.textContent = `Your score is: ${score}/${questions.length}`;
    };

    submitQuizBtn.addEventListener('click', submitQuiz);
});