<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit;
}

$userID = $_SESSION['userID'];

// Connect to database with error handling
$conn = new mysqli("localhost", "root", "", "readme_db");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Prepare query without cover_image
$query = "SELECT comics.id, comics.comicName AS title, comics.price 
          FROM carts 
          JOIN comics ON carts.comicID = comics.id 
          WHERE carts.userID = ?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Failed to prepare query: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Fetch cart items
$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

// Ensure response is always valid JSON
$response = [
    "success" => !empty($cartItems),
    "message" => empty($cartItems) ? "Your cart is empty." : "",
    "data"    => $cartItems
];

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

// Cleanup
$stmt->close();
$conn->close();
?>
