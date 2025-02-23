<?php
include 'backend/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$name = $_SESSION['name'];
$regID = $_SESSION['regID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ICT Olympic</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <header>
        <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Your Registration ID: <strong><?php echo htmlspecialchars($regID); ?></strong></p>
    </header>

</body>

</html>