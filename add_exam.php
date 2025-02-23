<?php
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $level = $_POST['level'];
    $subject = $_POST['subject'];
    $exam_date = $_POST['exam_date'];
    $exam_time = $_POST['exam_time'];
    $duration = $_POST['duration'];
    $status = "Not Scheduled"; // Default status

    $stmt = $conn->prepare("INSERT INTO exam_schedule (level, subject, exam_date, exam_time, duration, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $level, $subject, $exam_date, $exam_time, $duration, $status);

    if ($stmt->execute()) {
        $message = "Exam added successfully!";
    } else {
        $message = "Failed to add exam.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Exam - ICT Olympic</title>
</head>

<body>
    <h2>Add New Exam</h2>
    <?php if (isset($message)) {
        echo "<p>$message</p>";
    } ?>
    <form method="POST">
        <label>Level:</label>
        <select name="level" required>
            <option value="Secondary">Secondary</option>
            <option value="Higher Secondary">Higher Secondary</option>
            <option value="University">University</option>
        </select>
        <br>
        <label>Subject:</label>
        <input type="text" name="subject">
        <br>
        <label>Exam Date:</label>
        <input type="date" name="exam_date">
        <br>
        <label>Exam Time:</label>
        <input type="time" name="exam_time">
        <br>
        <label>Duration (minutes):</label>
        <input type="number" name="duration">
        <br>
        <button type="submit">Add Exam</button>
    </form>
</body>

</html>