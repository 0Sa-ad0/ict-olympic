<?php
session_start();
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $user_id = $_POST['user_id'];
    $answers = json_encode($_POST['answer']);

    $stmt = $conn->prepare("INSERT INTO exam_submissions (exam_id, user_id, answers) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $exam_id, $user_id, $answers);

    if ($stmt->execute()) {
        echo "Exam submitted successfully!";
    } else {
        echo "Failed to submit exam.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Exam - ICT Olympic</title>
</head>

</html>