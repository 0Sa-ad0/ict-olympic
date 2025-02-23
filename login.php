<?php
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $regID = $_POST['regID'];

    // Check if user exists in MySQL database
    $stmt = $conn->prepare("SELECT id, name, regID FROM users WHERE email = ? AND regID = ?");
    $stmt->bind_param("ss", $email, $regID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['regID'] = $user['regID'];

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or Registration ID!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ICT Olympic</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Registration</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <header>
        <h1>Login to ICT Olympic</h1>
    </header>

    <form method="POST">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Enter your Email" required>
        <input type="text" name="regID" placeholder="Enter your Registration ID" required>
        <button type="submit">Login</button>
    </form>

    <?php if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    } ?>

</body>

</html>