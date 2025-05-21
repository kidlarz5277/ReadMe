<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readme_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize input
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$birthdate = $_POST['birth'];

// Validate input
if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database using prepared statement
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, birthdate) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $birthdate);

if ($stmt->execute()) {
    echo
        "<script>
            alert('Registration successful');
            window.location.href = 'register.php';
        </script>";
} else {
    echo
    "<script>
        alert('Error');
        window.location.href = 'register.php';
    </script> " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
