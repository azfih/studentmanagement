<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Student Management System</h2>

        <?php if (!isset($_SESSION['user'])): ?>
            <!-- Registration Form -->
            <div class="card p-4 mt-3">
                <h3>Register</h3>
                <form action="register.php" method="POST">
                    <input type="text" class="form-control mb-2" name="name" placeholder="Enter Name" required>
                    <input type="email" class="form-control mb-2" name="email" placeholder="Enter Email" required>
                    <input type="password" class="form-control mb-2" name="password" placeholder="Enter Password" required>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>

            <!-- Login Form -->
            <div class="card p-4 mt-3">
                <h3>Login</h3>
                <form action="login.php" method="POST">
                    <input type="email" class="form-control mb-2" name="email" placeholder="Enter Email" required>
                    <input type="password" class="form-control mb-2" name="password" placeholder="Enter Password" required>
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>
            </div>
        <?php else: ?>
            <h3 class="text-center mt-4">Welcome, <?php echo $_SESSION['user']; ?>!</h3>
            <a href="enroll.php" class="btn btn-info w-100 mt-3">Go to Enrollment</a>
            <form action="logout.php" method="POST" class="mt-2">
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>