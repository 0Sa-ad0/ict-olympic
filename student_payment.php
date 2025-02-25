<?php
session_start();
include 'backend/db.php';

$student_id = $_SESSION['student_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $transaction_id = uniqid("PAY");

    $conn->query("INSERT INTO payments (user_id, amount, status, transaction_id) VALUES ($student_id, $amount, 'Completed', '$transaction_id')");

    echo "Payment successful! Transaction ID: $transaction_id";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Payment</title>
</head>

<body>
    <h2>Make Payment</h2>
    <form method="POST">
        <label>Amount:</label>
        <input type="number" name="amount" required>
        <button type="submit">Pay Now</button>
    </form>
</body>

</html>