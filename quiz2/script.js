const quizForm = document.getElementById("quiz-form");
const resultsEl = document.getElementById("results");
const timerEl = document.getElementById("timer"); // Assuming timer element exists

let timeLeft = 30; // Adjust for desired quiz duration
let intervalId;

quizForm.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent default form submission

  // Start or handle timer functionality
  if (!intervalId) {
    // Check if timer hasn't started yet
    startTimer();
  }

  // Submit the form using AJAX (optional)
  submitQuizWithAjax();
});

function startTimer() {
  intervalId = setInterval(() => {
    timerEl.textContent = `Time Remaining: ${timeLeft} seconds`;
    timeLeft--;
    if (timeLeft <= 0) {
      clearInterval(intervalId);
      submitQuizWithAjax(); // Submit quiz if timer runs out
    }
  }, 1000); // Update timer every second
}

function submitQuizWithAjax() {
  const formData = new FormData(quizForm); // Access form data

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "quiz.php", true); // Set request method and URL

  // Display loading indicator (optional)
  const loadingIndicator = document.createElement("div");
  loadingIndicator.textContent = "Submitting...";
  document.body.appendChild(loadingIndicator);

  xhr.onload = function () {
    if (xhr.status === 200) {
      // Check for successful response
      resultsEl.textContent = xhr.responseText; // Display results received from PHP script
      removeLoadingIndicator(); // Remove loading indicator after receiving response
    } else {
      alert("Error submitting quiz!");
      removeLoadingIndicator(); // Remove loading indicator even on error
    }
  };

  xhr.send(formData); // Send form data to PHP script
}

function removeLoadingIndicator() {
  const loadingIndicator = document.querySelector("#loadingIndicator"); // Assuming specific ID
  if (loadingIndicator) {
    loadingIndicator.parentNode.removeChild(loadingIndicator);
  }
}
