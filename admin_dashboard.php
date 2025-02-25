<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
</head>

<body>
    <h2>Welcome, <?php echo $_SESSION['admin_name']; ?></h2>
    <ul>
        <li><a href="manage_students.php">Manage Students</a></li>
        <li><a href="manage_exams.php">Manage Exams</a></li>
        <li><a href="manage_questions.php">Upload Questions</a></li>
        <li><a href="manage_payments.php">Manage Payments</a></li>
        <li><a href="publish_results.php">Publish Results</a></li>
        <li><a href="generate_reports.php">Generate Reports</a></li>
        <li><a href="admin_logout.php">Logout</a></li>
    </ul>
</body>

</html>