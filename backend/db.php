<?php
session_start(); // Start session

$servername = "localhost";
$username = "root";
$password = "";
$database = "ict_olympic";

// Create MySQL connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set UTF-8 Encoding for proper character support
$conn->set_charset("utf8");

// Uncomment this line to test connection
// echo "Connected successfully";
?>