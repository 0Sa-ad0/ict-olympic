<?php
session_start(); // Start the session

// Assuming the student ID is stored in the session after registration
if (isset($_SESSION['student_id'])) {
    echo json_encode(['student_id' => $_SESSION['student_id']]);
} else {
    echo json_encode(['student_id' => null]);
}
?>
