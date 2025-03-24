<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST['course'];
    $student = $_SESSION['user'];

    $stmt = $conn->prepare("INSERT INTO enrollments (student, course) VALUES (?, ?)");
    $stmt->bind_param("ss", $student, $course);

    if ($stmt->execute()) {
        echo "<script>alert('Enrollment successful!'); window.location.href='enroll.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$result = $conn->query("SELECT course FROM enrollments WHERE student='{$_SESSION['user']}'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['user']; ?></h2>

        <div class="card p-4 mt-3">
            <h3>Enroll in a Course</h3>
            <form action="" method="POST">
                <input type="text" class="form-control mb-2" name="course" placeholder="Enter Course Name" required>
                <button type="submit" class="btn btn-primary w-100">Enroll</button>
            </form>
        </div>

        <h3 class="mt-4">Your Enrolled Courses</h3>
        <ul class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item"><?php echo $row['course']; ?></li>
            <?php endwhile; ?>
        </ul>

        <form action="logout.php" method="POST" class="mt-3">
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>