<?php
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE exam_schedule SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $exam_id);

    if ($stmt->execute()) {
        $message = "Exam status updated successfully!";
    } else {
        $message = "Failed to update exam status.";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM exam_schedule ORDER BY exam_date, exam_time");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Exam Status - ICT Olympic</title>
</head>

<body>
    <h2>Update Exam Status</h2>
    <?php if (isset($message)) {
        echo "<p>$message</p>";
    } ?>
    <form method="POST">
        <label>Select Exam:</label>
        <select name="exam_id" required>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['level'] . " - " . $row['subject'] . " (" . $row['exam_date'] . ")"; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>
        <label>Status:</label>
        <select name="status" required>
            <option value="Scheduled">Scheduled</option>
            <option value="Ongoing">Ongoing</option>
            <option value="Completed">Completed</option>
            <option value="Cancelled">Cancelled</option>
        </select>
        <br>
        <button type="submit">Update Status</button>
    </form>
</body>

</html>