<?php
session_start();
include 'backend/db.php';

$user_id = $_SESSION['user_id'];
$results = $conn->query("SELECT e.subject, r.score, r.total_marks 
                         FROM exam_results r
                         JOIN exam_schedule e ON r.exam_id = e.id
                         WHERE r.user_id = $user_id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
</head>

<body>

    <h2>Your Exam Results</h2>
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>Score</th>
            <th>Total Marks</th>
            <th>Certificate</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['score']; ?></td>
                <td><?php echo $row['total_marks']; ?></td>
                <td>
                    <?php if ($row['score'] >= ($row['total_marks'] * 0.5)): ?>
                        <a href="generate_certificate.php?user_id=<?php echo $user_id; ?>">Download Certificate</a>
                    <?php else: ?>
                        Not Eligible
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>