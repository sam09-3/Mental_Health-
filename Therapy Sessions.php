<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "therapy_db"; // Ensure this database exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding a new therapy session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $session_type = $_POST["session_type"];
    $therapist_name = $_POST["therapist_name"];
    $session_date = $_POST["session_date"];
    $session_time = $_POST["session_time"];
    $description = $_POST["description"];

    $sql = "INSERT INTO therapy_sessions (session_type, therapist_name, session_date, session_time, description) 
            VALUES ('$session_type', '$therapist_name', '$session_date', '$session_time', '$description')";
    $conn->query($sql);
    echo "Therapy session added successfully";
}

// Fetch and return therapy sessions as JSON
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT * FROM therapy_sessions ORDER BY session_date ASC");
    $sessions = [];
    while ($row = $result->fetch_assoc()) {
        $sessions[] = [
            "id" => $row["id"],
            "session_type" => $row["session_type"],
            "therapist_name" => $row["therapist_name"],
            "session_date" => $row["session_date"],
            "session_time" => $row["session_time"],
            "description" => $row["description"]
        ];
    }
    echo json_encode($sessions);
}

$conn->close();
?>
