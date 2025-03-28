<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "schedule_db"; // Ensure this database exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle schedule addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["schedule"])) {
    $schedule = $_POST["schedule"];
    $sql = "INSERT INTO schedules (task) VALUES ('$schedule')";
    $conn->query($sql);
    echo "Task added successfully";
}

// Handle schedule deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];
    $sql = "DELETE FROM schedules WHERE id = $delete_id";
    $conn->query($sql);
    echo "Task deleted successfully";
}

// Fetch and return schedules as JSON
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT id, task, created_at FROM schedules ORDER BY created_at DESC");
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = [
            "id" => $row["id"],
            "task" => $row["task"],
            "time" => date("Y-m-d H:i:s", strtotime($row["created_at"]))
        ];
    }
    echo json_encode($tasks);
}

$conn->close();
?>
