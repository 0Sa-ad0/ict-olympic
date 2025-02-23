<?php
include 'backend/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $institution = $_POST['institution'];
    $level = $_POST['level'];
    $division = isset($_POST['division']) ? $_POST['division'] : null;

    // Generate a unique Registration ID
    $regID = "ICT" . strtoupper(substr($name, 0, 3)) . rand(1000, 9999);

    // Insert into MySQL
    $stmt = $conn->prepare("INSERT INTO users (name, email, mobile, institution, level, division, regID, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("sssssss", $name, $email, $mobile, $institution, $level, $division, $regID);

    if ($stmt->execute()) {
        $message = "Registration successful! Your Registration ID: $regID";
        $paymentAvailable = true;
    } else {
        $message = "Registration failed. Please try again.";
        $paymentAvailable = false;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ICT Olympic</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script defer src="assets/script.js"></script>
</head>

<body>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Registration</a></li>
        </ul>
    </nav>

    <header>
        <h1>Register for ICT Olympic</h1>
    </header>

    <form method="POST">
        <h2>Personal Information</h2>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required>

        <h2>Educational Institution</h2>
        <input type="text" name="institution" placeholder="School/College/University Name" required>

        <h2>Level</h2>
        <select name="level" id="levelSelect" required onchange="toggleDivision()">
            <option value="">Select Level</option>
            <option value="Secondary">Secondary</option>
            <option value="Higher Secondary">Higher Secondary</option>
            <option value="University">University</option>
        </select>

        <div id="divisionSection" style="display: none;">
            <h2>University Division</h2>
            <label><input type="radio" name="division" value="Departmental"> Departmental</label>
            <label><input type="radio" name="division" value="Non-Departmental"> Non-Departmental</label>
        </div>

        <button type="submit">Register</button>
    </form>

    <?php if (isset($message)) {
        echo "<p>$message</p>";
    } ?>
    <?php if (isset($paymentAvailable) && $paymentAvailable): ?>
        <button onclick="window.location.href='payment.php'">Proceed to Payment</button>
    <?php endif; ?>

</body>

</html>