<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "events_db"; // Ensure this database exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding a new event
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $location = $_POST["location"];
    $description = $_POST["description"];

    $sql = "INSERT INTO events (title, event_date, event_time, location, description) 
            VALUES ('$title', '$event_date', '$event_time', '$location', '$description')";
    $conn->query($sql);
    echo "Event added successfully";
}

// Fetch and return events as JSON
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = [
            "id" => $row["id"],
            "title" => $row["title"],
            "event_date" => $row["event_date"],
            "event_time" => $row["event_time"],
            "location" => $row["location"],
            "description" => $row["description"]
        ];
    }
    echo json_encode($events);
}

$conn->close();
?>
