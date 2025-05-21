<?php
// Ensure no whitespace or BOM before this tag
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readme_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Validate input
$comic_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$comic_id) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid or missing comic ID"]);
    exit;
}

// Prepare query safely
$stmt = $conn->prepare("SELECT c.id, c.comicName AS title, c.cover_image, c.description, g.name AS genre, a.name AS author, c.price
FROM comics c
JOIN genres g ON c.genreID = g.id
JOIN authors a ON c.authorID = a.id
WHERE c.id = ?
");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to prepare statement"]);
    exit;
}

$stmt->bind_param("i", $comic_id);
$stmt->execute();
$result = $stmt->get_result();

$comic = $result->fetch_assoc();
if (!$comic) {
    http_response_code(404);
    echo json_encode(["error" => "Comic not found"]);
} else {
    $comic['cover_url'] = 'uploads/covers/' . basename($comic['cover_image']);
    unset($comic['cover_image']); // hide DB field
    echo json_encode($comic);
}

$stmt->close();
$conn->close();
?>
