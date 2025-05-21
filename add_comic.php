add_comic.php
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readme_db";

try {
    // Establish connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    } 

    // Sanitize input data
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    if (!$title || !$author || !$genre || !$price || !$description) {
        throw new Exception("Invalid input data.");
    }

    // Define storage paths (Ensure folders exist)
    $comicDir = __DIR__ . "/uploads/comics/";
    $coverDir = __DIR__ . "/uploads/covers/";

    if (!is_dir($comicDir)) mkdir($comicDir, 0775, true);
    if (!is_dir($coverDir)) mkdir($coverDir, 0775, true);

    // Validate file uploads (Allow .pdf, .cbz, .cbr for comics)
    $allowedComicTypes = ['application/pdf', 'application/x-cbr', 'application/x-cbz', 'application/octet-stream'];
    $allowedImageTypes = ['image/png', 'image/jpeg'];

    $comicTmp = $_FILES["comicFile"]["tmp_name"];
    $coverTmp = $_FILES["coverImage"]["tmp_name"];

    $comicMime = mime_content_type($comicTmp);
    $coverMime = mime_content_type($coverTmp);

    $comicExt = strtolower(pathinfo($_FILES["comicFile"]["name"], PATHINFO_EXTENSION));
    $allowedExtensions = ['pdf', 'cbz', 'cbr'];

    if (!in_array($comicMime, $allowedComicTypes) && !in_array($comicExt, $allowedExtensions)) {
        throw new Exception("Invalid comic file type. Allowed: PDF, CBZ, CBR.");
    }
    if (!in_array($coverMime, $allowedImageTypes)) {
        throw new Exception("Invalid cover image type. Allowed: PNG, JPEG.");
    }

    // Generate unique filenames
    $comicFile = $comicDir . time() . "_" . basename($_FILES["comicFile"]["name"]);
    $coverFile = $coverDir . time() . "_" . basename($_FILES["coverImage"]["name"]);

    // Move uploaded files
    if (!move_uploaded_file($comicTmp, $comicFile) || !move_uploaded_file($coverTmp, $coverFile)) {
        throw new Exception("File upload failed.");
    }

    // Handle Author
    $stmt = $conn->prepare("SELECT id FROM authors WHERE name = ?");
    $stmt->bind_param("s", $author);
    $stmt->execute();
    $result = $stmt->get_result();
    $authorID = ($result->num_rows > 0) ? $result->fetch_assoc()['id'] : null;

    if (!$authorID) {
        $stmt = $conn->prepare("INSERT INTO authors (name) VALUES (?)");
        $stmt->bind_param("s", $author);
        $stmt->execute();
        $authorID = $stmt->insert_id;
    }

    // Handle Genre
    $stmt = $conn->prepare("SELECT id FROM genres WHERE name = ?");
    $stmt->bind_param("s", $genre);
    $stmt->execute();
    $result = $stmt->get_result();
    $genreID = ($result->num_rows > 0) ? $result->fetch_assoc()['id'] : null;

    if (!$genreID) {
        $stmt = $conn->prepare("INSERT INTO genres (name) VALUES (?)");
        $stmt->bind_param("s", $genre);
        $stmt->execute();
        $genreID = $stmt->insert_id;
    }

    // Insert Comic into database
    $stmt = $conn->prepare("INSERT INTO comics (comicName, authorID, genreID, price, description, file_path, cover_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siidsss", $title, $authorID, $genreID, $price, $description, $comicFile, $coverFile);

    if ($stmt->execute()) {
        echo "<script>
                alert('Comic added successfully!');
                window.location.href='addcomic.html';
              </script>";
    } else {
        throw new Exception("Error: " . $stmt->error);
    }
} catch (Exception $e) {
    echo "<script>
            alert('Error: " . addslashes($e->getMessage()) . "');
            window.location.href='addcomic.html';
          </script>";
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}
?>