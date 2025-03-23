<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
</head>
<body>
    <h2>Welcome to Student Management System</h2>

    <!-- Registration Form -->
    <h3>Register</h3>
    <form action="register.php" method="POST">
        <input type="text" name="name" placeholder="Enter Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
    </form>

    <!-- Login Form -->
    <h3>Login</h3>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>

    <?php if (isset($_SESSION['user'])): ?>
        <h3>Welcome, <?php echo $_SESSION['user']; ?>!</h3>

        <!-- Course Enrollment -->
        <h3>Enroll in a Course</h3>
        <form action="enroll.php" method="POST">
            <input type="text" name="course" placeholder="Enter Course Name" required>
            <button type="submit">Enroll</button>
        </form>

        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    <?php endif; ?>
</body>
</html>
