<?php
session_start();
include 'backend/db.php';

$result = $conn->query("SELECT * FROM exam_schedule");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Exam Schedule</title>
</head>

<body>
    <h2>Exam Schedule</h2>
    <table border="1">
        <tr>
            <th>Level</th>
            <th>Subject</th>
            <th>Exam Date</th>
            <th>Exam Time</th>
        </tr>
        <?php while ($exam = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $exam['level']; ?></td>
                <td><?php echo $exam['subject']; ?></td>
                <td><?php echo $exam['exam_date']; ?></td>
                <td><?php echo $exam['exam_time']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>