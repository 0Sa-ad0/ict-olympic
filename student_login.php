<?php
session_start();
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $regID = $_POST['regID'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM students WHERE regID = '$regID'");
    $student = $result->fetch_assoc();

    if ($student && password_verify($password, $student['password'])) {
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['name'] = $student['name'];
        $_SESSION['regID'] = $student['regID'];
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid Registration ID or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Login</title>
</head>

<body>
    <h2>Login to Student Panel</h2>
    <form method="POST">
        <input type="text" name="regID" placeholder="Enter Registration ID" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error))
        echo "<p style='color:red;'>$error</p>"; ?>
</body>

</html>