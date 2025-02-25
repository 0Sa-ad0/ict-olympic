<?php
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $question_text = $_POST['question_text'];
    $question_type = $_POST['question_type'];
    $correct_answer = $_POST['correct_answer'];

    $options = null;
    if ($question_type == "MCQ") {
        $options = json_encode(explode(",", $_POST['options']));
    }

    $stmt = $conn->prepare("INSERT INTO exam_questions (exam_id, question_text, question_type, options, correct_answer) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $exam_id, $question_text, $question_type, $options, $correct_answer);

    if ($stmt->execute()) {
        $message = "Question added successfully!";
    } else {
        $message = "Failed to add question.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
</head>

<body>

    <h2>Add Question</h2>
    <?php if (isset($message)) {
        echo "<p>$message</p>";
    } ?>

    <form method="POST">
        <label>Exam ID:</label>
        <input type="number" name="exam_id" required><br>
        <label>Question:</label>
        <textarea name="question_text" required></textarea><br>
        <label>Question Type:</label>
        <select name="question_type" required>
            <option value="MCQ">MCQ</option>
            <option value="Written">Written</option>
        </select><br>
        <label>Options (Comma Separated for MCQs):</label>
        <input type="text" name="options"><br>
        <label>Correct Answer:</label>
        <input type="text" name="correct_answer" required><br>
        <button type="submit">Add Question</button>
    </form>

</body>

</html>