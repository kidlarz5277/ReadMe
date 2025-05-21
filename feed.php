<?php
// 1. Connect to the database
$conn = new mysqli("localhost", "root", "", "readme_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Collect data from the form
$name = $_POST['name'];  // You can store or display this, though it's not in the DB
$email = $_POST['email'];
$message = $_POST['message'];

// 3. Find the user ID by matching the email
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($user_id);
$user_found = $stmt->fetch();
$stmt->close();

// 4. Proceed if user exists
if ($user_found) {
    // Insert feedback into feedbacks table
    $insert = $conn->prepare("INSERT INTO feedbacks (email, message, user_id) VALUES (?, ?, ?)");
    $insert->bind_param("ssi", $email, $message, $user_id);

    if ($insert->execute()) {
        echo "<script>alert('Thank you for your feedback!'); window.location.href='feedback.html';</script>";
    } else {
        echo "Insert error: " . $insert->error;
    }

    $insert->close();
} else {
    echo "<script>alert('No user found with that email. Please register or check your email.'); window.location.href='feedback.html';</script>";
}

$conn->close();
?>
