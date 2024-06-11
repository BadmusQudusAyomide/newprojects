const questionEl = document.getElementById('question');
const imageContainerEl = document.getElementById('image-container'); 
const answerChoicesEl = document.getElementById('answer-choices');
const timerEl = document.getElementById('timer');
const submitBtn = document.getElementById('submit-btn');

let currentQuestionIndex = 0;
let timeLeft = 30; // Adjust for desired quiz duration
let intervalId; // To store timer interval

function startQuiz() {
  // Fetch quiz questions and answers from server-side script (replace with actual logic)
  const questions = [
    {
      question: 'What is the capital of France?',
      image: 'path/to/image.jpg', // Optional image path
      answers: ['London', 'Paris', 'Berlin', 'Madrid'],
      correctAnswer: 1
    },
    // Add more questions here
  ];

  displayQuestion(questions[currentQuestionIndex]);
  startTimer();
}

function displayQuestion(question) {
  questionEl.textContent = question.question;
  answerChoicesEl.innerHTML = ''; // Clear previous choices

  if (question.image) {
    const image = document.createElement('img');
    image.src = question.image;
    imageContainerEl.appendChild(image);
  } else {
    imageContainerEl.innerHTML = ''; // Clear any existing image
  }

  question.answers.forEach((answer, index) => {
    const answerChoice = document.createElement('li');
    answerChoice.textContent = answer;
    answerChoice.dataset.index = index; // Store answer index for checking
    answerChoice.addEventListener('click', handleAnswerSelection);
    answerChoicesEl.appendChild(answerChoice);
  });
}

function handleAnswerSelection(event) {
  const selectedAnswerIndex = parseInt(event.target.dataset.index);
  // (Implement logic to store user's selected answer)

  // Check if all questions answered or timer runs out
  if (currentQuestionIndex === questions.length - 1 || timeLeft <= 0) {
    clearInterval(intervalId); // Stop the timer
    submitQuiz(); // (Call function to submit quiz and display results)
  } else {
    currentQuestionIndex++;
    displayQuestion(questions[currentQuestionIndex]);
  }
}

function startTimer() {
  intervalId = setInterval(() => {
    timerEl.textContent = `Time Remaining: ${timeLeft} seconds`;
    timeLeft--;
    if (timeLeft <= 0) {
      clearInterval(intervalId);
      submitQuiz(); // (Call function to submit quiz and display results)
    }
  }, 1000); // Update timer every second
}

function submitQuiz() {
  // (Implement logic to send user's answers and calculate score using server-side script)
  alert('Quiz submitted! Your score will be displayed shortly.'); // Replace with actual result display
}

startQuiz(); // Call function to start the quiz
