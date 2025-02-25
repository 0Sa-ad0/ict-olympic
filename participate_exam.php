<?php
session_start();
include 'backend/db.php';

$student_id = $_SESSION['student_id'];

$result = $conn->query("SELECT * FROM exam_schedule WHERE exam_date = CURDATE()");
$exam = $result->fetch_assoc();

if (!$exam) {
    die("No exam is scheduled for today.");
}

// Enable "Start Exam" button when the time arrives
$current_time = date("H:i:s");
$exam_time = $exam['exam_time'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Participate in Exam</title>
</head>

<body>
    <h2>Today's Exam</h2>
    <p>Subject: <?php echo $exam['subject']; ?></p>
    <p>Time: <?php echo $exam['exam_time']; ?></p>

    <?php if ($current_time >= $exam_time): ?>
        <a href="start_exam.php?exam_id=<?php echo $exam['id']; ?>"><button>Start Exam</button></a>
    <?php else: ?>
        <p>Exam is not yet started. Please wait...</p>
    <?php endif; ?>
</body>

</html>