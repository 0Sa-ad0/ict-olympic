<?php
include 'backend/db.php';

function gradeExam($exam_id, $user_id)
{
    global $conn;

    // Get correct answers
    $questions = $conn->query("SELECT id, question_type, correct_answer FROM exam_questions WHERE exam_id = $exam_id");

    $correctAnswers = [];
    while ($q = $questions->fetch_assoc()) {
        $correctAnswers[$q['id']] = $q['correct_answer'];
    }

    // Get user answers
    $result = $conn->query("SELECT answers FROM exam_submissions WHERE exam_id = $exam_id AND user_id = $user_id");
    $submission = $result->fetch_assoc();
    $userAnswers = json_decode($submission['answers'], true);

    // Calculate score
    $score = 0;
    $totalMarks = count($correctAnswers);

    foreach ($correctAnswers as $q_id => $correct) {
        if (isset($userAnswers[$q_id]) && strtolower(trim($userAnswers[$q_id])) == strtolower(trim($correct))) {
            $score++;
        }
    }

    // Store result
    $stmt = $conn->prepare("INSERT INTO exam_results (exam_id, user_id, score, total_marks) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $exam_id, $user_id, $score, $totalMarks);
    $stmt->execute();
}

// Run grading for all students in the exam
$exam_id = $_GET['exam_id'];
$students = $conn->query("SELECT user_id FROM exam_submissions WHERE exam_id = $exam_id");

while ($student = $students->fetch_assoc()) {
    gradeExam($exam_id, $student['user_id']);
}

echo "Results generated successfully!";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h2>Generate Results</h2>
    <p>Results have been generated successfully!</p>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>

</html>