<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- Registration Page -->
<form action="register.php" method="POST">
    <input type="text" name="name" placeholder="Enter Name" required>
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit">Register</button>
</form>

<?php
// register.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- Login Page -->
<form action="login.php" method="POST">
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit">Login</button>
</form>

<?php
// login.php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            echo "Login successful!";
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!-- Course Enrollment Page -->
<form action="enroll.php" method="POST">
    <input type="text" name="course" placeholder="Enter Course Name" required>
    <button type="submit">Enroll</button>
</form>

<?php
// enroll.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST['course'];i
    $sql = "INSERT INTO enrollments (student, course) VALUES ('" . $_SESSION['user'] . "', '$course')";
    if ($conn->query($sql) === TRUE) {
        echo "Enrollment successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
