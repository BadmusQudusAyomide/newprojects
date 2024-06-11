    const lessons = [
        {
        title: "Introduction to Python",
        content: "Python is an interpreted, high-level and general-purpose programming language. Python's design philosophy emphasizes code readability with its notable use of significant whitespace.",
        quiz: [
            {
                question: "What type of language is Python?",
                options: ["Compiled", "Interpreted", "Both", "None"],
                answer: "Interpreted"
            },
            {
                question: "What does Python emphasize in its design?",
                options: ["Speed", "Memory Management", "Code Readability", "Syntax Complexity"],
                answer: "Code Readability"
            }
        ]
    },
    {
        title: "Variables in Python",
        content: "Variables are containers for storing data values. Python has no command for declaring a variable.",
        quiz: [
            {
                question: "How do you declare a variable in Python?",
                options: ["var x = 5", "x = 5", "int x = 5", "declare x = 5"],
                answer: "x = 5"
            },
            {
                question: "Can Python variables change type after assignment?",
                options: ["Yes", "No"],
                answer: "Yes"
            }
        ]
    },
    // Add more lessons as needed
];

document.addEventListener('DOMContentLoaded', () => {
    const lessonList = document.getElementById('lesson-list');
    const lessonTitle = document.getElementById('lesson-title');
    const lessonContent = document.getElementById('lesson-content');
    const startQuizButton = document.getElementById('start-quiz');
    const quizSection = document.querySelector('.quiz');
    const quizContent = document.getElementById('quiz-content');
    const submitQuizButton = document.getElementById('submit-quiz');
    const quizResult = document.getElementById('quiz-result');

    lessons.forEach((lesson, index) => {
        const li = document.createElement('li');
        li.textContent = lesson.title;
        li.addEventListener('click', () => {
            lessonTitle.textContent = lesson.title;
            lessonContent.textContent = lesson.content;
            startQuizButton.style.display = 'block';
            startQuizButton.dataset.lessonIndex = index;
        });
        lessonList.appendChild(li);
    });

    startQuizButton.addEventListener('click', () => {
        const lessonIndex = startQuizButton.dataset.lessonIndex;
        const selectedLesson = lessons[lessonIndex];
        
        quizContent.innerHTML = '';
        selectedLesson.quiz.forEach((q, idx) => {
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('quiz-question');
            
            const questionText = document.createElement('p');
            questionText.textContent = `${idx + 1}. ${q.question}`;
            questionDiv.appendChild(questionText);

            q.options.forEach(option => {
                const label = document.createElement('label');
                label.textContent = option;
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = `question${idx}`;
                input.value = option;
                label.insertBefore(input, label.firstChild);
                questionDiv.appendChild(label);
            });

            quizContent.appendChild(questionDiv);
        });

        quizSection.style.display = 'block';
    });

    submitQuizButton.addEventListener('click', () => {
        const lessonIndex = startQuizButton.dataset.lessonIndex;
        const selectedLesson = lessons[lessonIndex];
        let score = 0;

        selectedLesson.quiz.forEach((q, idx) => {
            const selectedOption = document.querySelector(`input[name="question${idx}"]:checked`);
            if (selectedOption && selectedOption.value === q.answer) {
                score++;
            }
        });

        quizResult.textContent = `You scored ${score} out of ${selectedLesson.quiz.length}`;
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const authSection = document.getElementById('auth-section');
    const lessonSection = document.getElementById('lesson-section');

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
            const response = await fetch('http://localhost/newprojects/python/register.php', {
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
                lessonSection.style.display = 'block';
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
            const response = await fetch("http://localhost/newprojects/python/login.php",
              {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                body: JSON.stringify({ email, password }),
              }
            );

            const result = await response.json();
            alert(result.message);
            if (result.status === 'success') {
                authSection.style.display = 'none';
                lessonSection.style.display = 'block';
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});

