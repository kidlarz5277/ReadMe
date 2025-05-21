<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "readme_db";

// Connect to database
$conn = new mysqli($host, $user, $pass, $dbname);

// Handle connection error
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Query genres
$sql = "SELECT id, name FROM genres";
$result = $conn->query($sql);

$genres = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $genres[] = [
            'id' => $row['id'],
            'name' => $row['name']
        ];
    }
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($genres);

// Clean up
$conn->close();
?>
