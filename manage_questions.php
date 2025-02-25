<?php
session_start();
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $question = $_POST['question'];
    $options = json_encode($_POST['options']);
    $correct_answer = $_POST['correct_answer'];
    $question_type = $_POST['question_type'];

    $stmt = $conn->prepare("INSERT INTO exam_questions (exam_id, question, options, correct_answer, question_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $exam_id, $question, $options, $correct_answer, $question_type);
    $stmt->execute();

    echo "Question added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Upload Questions</title>
</head>

<body>
    <h2>Add New Question</h2>
    <form method="POST">
        <label>Exam ID:</label>
        <input type="number" name="exam_id" required>

        <label>Question:</label>
        <textarea name="question" required></textarea>

        <label>Options (Comma-separated for MCQ):</label>
        <input type="text" name="options" required>

        <label>Correct Answer:</label>
        <input type="text" name="correct_answer" required>

        <label>Question Type:</label>
        <select name="question_type">
            <option value="MCQ">MCQ</option>
            <option value="Written">Written</option>
        </select>

        <button type="submit">Upload Question</button>
    </form>
</body>

</html>