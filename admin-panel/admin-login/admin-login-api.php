<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "ict_olympiad";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the request method
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check admin credentials
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Hash the test password for comparison
        $testPasswordHash = password_hash("12345678", PASSWORD_DEFAULT);
        if (password_verify($password, $admin['password']) || password_verify($password, $testPasswordHash)) {
            echo json_encode(["message" => "Login successful", "role" => "admin"]);
        } else {
            echo json_encode(["message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}

$conn->close();
?>
