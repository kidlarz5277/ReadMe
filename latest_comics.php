<?php
$host = "localhost";
$user = "root";
$password = ""; // Update if needed
$dbname = "readme_db";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Prepare SQL query
$sql = "SELECT id, comicName, cover_image FROM comics ORDER BY uploaded_at DESC LIMIT 10";
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(["error" => "SQL error: " . $conn->error]));
}

$comics = [];

// Fetch results
while ($row = $result->fetch_assoc()) {
    $cover_path = !empty($row['cover_image']) ? 'uploads/covers/' . basename($row['cover_image']) : 'assets/default_cover.jpg'; 

    $comics[] = [
        'id' => $row['id'],
        'title' => $row['comicName'],
        'cover_url' => $cover_path
    ];
}

$conn->close();

// Set JSON headers
header('Content-Type: application/json');
echo json_encode($comics, JSON_PRETTY_PRINT);
?>
