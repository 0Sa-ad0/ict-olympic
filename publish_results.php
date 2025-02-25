<?php
session_start();
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];

    $conn->query("UPDATE exam_results SET published = 1 WHERE exam_id = $exam_id");
    echo "Results published successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Publish Results</title>
</head>

<body>
    <h2>Publish Exam Results</h2>
    <form method="POST">
        <label>Exam ID:</label>
        <input type="number" name="exam_id" required>
        <button type="submit">Publish Results</button>
    </form>
</body>

</html>