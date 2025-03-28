<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "selfcare_db"; // Ensure this database exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding a new self-care resource
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];

    if (empty($title) || empty($description)) {
        echo "Both fields are required!";
        exit;
    }

    $sql = "INSERT INTO self_care_resources (title, description) VALUES ('$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Self-care resource added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch and return self-care resources as JSON
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT * FROM self_care_resources ORDER BY created_at DESC");
    $resources = [];
    while ($row = $result->fetch_assoc()) {
        $resources[] = [
            "id" => $row["id"],
            "title" => $row["title"],
            "description" => $row["description"]
        ];
    }
    echo json_encode($resources);
}

$conn->close();
?>
