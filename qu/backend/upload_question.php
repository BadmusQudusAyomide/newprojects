<?php
include 'config.php';

$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correct_option = $_POST['correct_option'];
$image_path = null;

if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image_path = "images/" . basename($_FILES["image"]["name"]);
}

$sql = "INSERT INTO questions (question, image_path, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $question, $image_path, $option1, $option2, $option3, $option4, $correct_option);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Question uploaded successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>