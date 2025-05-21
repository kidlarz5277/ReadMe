<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "readme_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

$genre_id = isset($_GET['genre_id']) ? intval($_GET['genre_id']) : null;

$sql = "SELECT id, comicName, cover_image FROM comics";
$params = [];
$types = "";

if (!empty($genre_id)) {
    $sql .= " WHERE genreID = ?";
    $params[] = $genre_id;
    $types .= "i";
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$comics = [];

while ($row = $result->fetch_assoc()) {
    if (!empty($row['cover_image'])) {
        $filename = basename($row['cover_image']);
        $comics[] = [
            'id' => $row['id'],
            'title' => $row['comicName'],
            'cover_url' => 'uploads/covers/' . $filename
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($comics);

$stmt->close();
$conn->close();
?>
