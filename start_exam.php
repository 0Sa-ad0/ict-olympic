<?php
session_start();
include 'backend/db.php';

$user_id = $_SESSION['user_id']; // User must be logged in
$exam_id = $_GET['exam_id'];

// Get exam details
$exam = $conn->query("SELECT * FROM exam_schedule WHERE id = $exam_id")->fetch_assoc();
$start_time = strtotime($exam['exam_date'] . ' ' . $exam['exam_time']);
$current_time = time();
$end_time = $start_time + ($exam['duration'] * 60);

// Check if exam is available to start
if ($current_time < $start_time) {
    die("Exam has not started yet. Please wait.");
} elseif ($current_time > $end_time) {
    die("Exam time is over.");
}

// Get exam questions
$questions = $conn->query("SELECT * FROM exam_questions WHERE exam_id = $exam_id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam - ICT Olympic</title>
    <script>
        let endTime = <?php echo $end_time; ?>;
        function updateTimer() {
            let now = Math.floor(Date.now() / 1000);
            let remaining = endTime - now;
            if (remaining <= 0) {
                document.getElementById("examForm").submit();
            }
            let minutes = Math.floor(remaining / 60);
            let seconds = remaining % 60;
            document.getElementById("timer").innerText = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        }
        setInterval(updateTimer, 1000);
    </script>
</head>

<body>

    <h2>Exam: <?php echo $exam['subject']; ?></h2>
    <p>Time Left: <span id="timer"></span></p>

    <form id="examForm" method="POST" action="submit_exam.php">
        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <?php while ($q = $questions->fetch_assoc()): ?>
            <p><?php echo $q['question_text']; ?></p>
            <?php if ($q['question_type'] == "MCQ"):
                $options = json_decode($q['options'], true); ?>
                <?php foreach ($options as $option): ?>
                    <label>
                        <input type="radio" name="answer[<?php echo $q['id']; ?>]" value="<?php echo $option; ?>">
                        <?php echo $option; ?>
                    </label><br>
                <?php endforeach; ?>
            <?php else: ?>
                <textarea name="answer[<?php echo $q['id']; ?>]" rows="3"></textarea>
            <?php endif; ?>
            <br><br>
        <?php endwhile; ?>

        <button type="submit">Submit Exam</button>
    </form>

</body>

</html>