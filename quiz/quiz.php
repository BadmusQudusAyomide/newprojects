<?php
// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "quiz_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to fetch all questions from the database
function getQuestions() {
  global $conn;
  $sql = "SELECT * FROM questions";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  } else {
    return [];
  }
}

// Function to check submitted answers and calculate score
function checkAnswers($questions, $userAnswers) {
  $score = 0;
  foreach ($questions as $i => $question) {
    if ($question['correct_answer'] == $userAnswers[$i]) {
      $score++;
    }
  }
  return $score;
}

// Handle user actions (optional, replace with actual form handling)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $userAnswers = $_POST['answer']; // Assuming answer choices are submitted with name="answer[]"
  $questions = getQuestions();
  $score = checkAnswers($questions, $userAnswers);

  // (Logic to store user score or display results)
  echo "Your score is: " . $score . " out of " . count($questions);
}

// Display quiz questions and answer choices (replace with actual HTML integration)
$questions = getQuestions();
if (!empty($questions)) {
  foreach ($questions as $question) {
    echo "<h3>" . $question['question'] . "</h3>";
    if ($question['image']) {
      echo "<img src='" . $question['image'] . "' alt='Question Image'>";
    }
    for ($i = 1; $i <= 4; $i++) {
      echo "<input type='radio' name='answer[]' value='$i'>" . $question['answer' . $i] . "<br>";
    }
    echo "<hr>";
  }
  echo "<button type='submit'>Submit Quiz</button>";
} else {
  echo "No questions found in the database.";
}

$conn->close();
?>