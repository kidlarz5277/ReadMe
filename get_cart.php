<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['userID'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit;
}

$userID = $_SESSION['userID'];

$conn = new mysqli("localhost", "root", "", "readme_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

$query = "SELECT comics.id, comics.title, comics.cover_url, comics.price 
          FROM carts 
          JOIN comics ON carts.comicID = comics.id 
          WHERE carts.userID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

echo json_encode($cartItems);

$stmt->close();
$conn->close();
?>
