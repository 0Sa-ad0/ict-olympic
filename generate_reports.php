<?php
session_start();
include 'backend/db.php';

$students = $conn->query("SELECT * FROM users");
$payments = $conn->query("SELECT * FROM payments");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Generate Reports</title>
</head>

<body>
    <h2>Student Reports</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Institution</th>
            <th>Level</th>
        </tr>
        <?php while ($row = $students->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['institution']; ?></td>
                <td><?php echo $row['level']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Payment Reports</h2>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Transaction ID</th>
        </tr>
        <?php while ($row = $payments->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['transaction_id']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>