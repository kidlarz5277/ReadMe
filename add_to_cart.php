<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['userID'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['comicID'])) {
    echo json_encode(["success" => false, "message" => "Comic ID missing."]);
    exit;
}

$userID = $_SESSION['userID'];
$comicID = $data['comicID'];

$conn = new mysqli("localhost", "root", "", "readme_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

// Check if comic already exists in user's cart
$checkStmt = $conn->prepare("SELECT id FROM carts WHERE userID = ? AND comicID = ?");
$checkStmt->bind_param("ii", $userID, $comicID);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Comic is already in your cart."]);
    exit;
}

$checkStmt->close();

// Insert comic into cart
$stmt = $conn->prepare("INSERT INTO carts (userID, comicID) VALUES (?, ?)");
$stmt->bind_param("ii", $userID, $comicID);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Comic added to cart."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to add comic to cart."]);
}

$stmt->close();
$conn->close();
?>
