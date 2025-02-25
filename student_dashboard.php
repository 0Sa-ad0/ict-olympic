<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Dashboard</title>
</head>

<body>
    <h2>Welcome, <?php echo $_SESSION['name']; ?> (<?php echo $_SESSION['regID']; ?>)</h2>
    <ul>
        <li><a href="exam_schedule.php">View Exam Schedule</a></li>
        <li><a href="participate_exam.php">Participate in Exam</a></li>
        <li><a href="view_results.php">View Results</a></li>
        <li><a href="student_payment.php">Make Payment</a></li>
        <li><a href="student_logout.php">Logout</a></li>
    </ul>
</body>

</html>