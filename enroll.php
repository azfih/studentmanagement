<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user'])) {
    $course = $_POST['course'];
    $student = $_SESSION['user'];

    $stmt = $conn->prepare("INSERT INTO enrollments (student, course) VALUES (?, ?)");
    $stmt->bind_param("ss", $student, $course);

    if ($stmt->execute()) {
        echo "Enrollment successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Please log in to enroll.";
}
?>
