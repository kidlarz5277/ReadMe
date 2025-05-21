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

// Get user input
$email = $_POST['email'];
$password = $_POST['password'];

// First, check admin credentials
$admin_sql = "SELECT * FROM admins WHERE email = ?";
$stmt = $conn->prepare($admin_sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$admin_result = $stmt->get_result();

if ($admin_result->num_rows === 1) {
    $admin = $admin_result->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
        $_SESSION['userID'] = $admin['id'];  // Store admin ID in session
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'admin';
        header("Location: admin.html");
        exit();
    }
}

// Then, check user credentials
$user_sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows === 1) {
    $user = $user_result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['userID'] = $user['id'];  // Store user ID in session
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'user';
        header("Location: homepage.html");
        exit();
    }
}

// No match found
echo
    "<script>
        alert('Invalid username or password');
        window.location.href = 'index.php';
    </script>";
$stmt->close();
$conn->close();
?>
