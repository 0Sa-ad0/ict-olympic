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

    // Check if the user is a student
    $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo json_encode(["message" => "Login successful", "role" => "student"]);
        } else {
            echo json_encode(["message" => "Invalid password"]);
        }
    } else {
        // Check if the user is an admin
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                echo json_encode(["message" => "Login successful", "role" => "admin"]);
            } else {
                echo json_encode(["message" => "Invalid password"]);
            }
        } else {
            echo json_encode(["message" => "User not found"]);
        }
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}

$conn->close();
?>
