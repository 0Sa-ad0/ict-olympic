<?php
include 'backend/db.php';

$result = $conn->query("SELECT * FROM exam_schedule ORDER BY exam_date, exam_time");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedule - ICT Olympic</title>
</head>

<body>
    <h2>Exam Schedule</h2>
    <table border="1">
        <tr>
            <th>Level</th>
            <th>Subject</th>
            <th>Exam Date</th>
            <th>Exam Time</th>
            <th>Duration (Minutes)</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['level']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['exam_date']; ?></td>
                <td><?php echo $row['exam_time']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>