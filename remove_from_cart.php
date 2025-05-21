<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['comicID']) || !is_numeric($data['comicID'])) {
    echo json_encode(["success" => false, "message" => "Invalid or missing Comic ID."]);
    exit;
}

$userID = $_SESSION['userID'];
$comicID = (int) $data['comicID'];

$conn = new mysqli("localhost", "root", "", "readme_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM carts WHERE userID = ? AND comicID = ?");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Failed to prepare SQL statement."]);
    $conn->close();
    exit;
}

$stmt->bind_param("ii", $userID, $comicID);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Comic removed from cart."]);
    } else {
        echo json_encode(["success" => false, "message" => "Comic not found in your cart."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Failed to remove comic."]);
}

$stmt->close();
$conn->close();
?>
