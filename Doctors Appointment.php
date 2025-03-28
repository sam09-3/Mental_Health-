<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "doctor_db"; // Ensure this matches your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle adding a new doctor appointment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["patient_name"])) {
    $patient_name = $_POST["patient_name"];
    $doctor_name = $_POST["doctor_name"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];
    $reason = $_POST["reason"];

    if (empty($patient_name) || empty($doctor_name) || empty($appointment_date) || empty($appointment_time) || empty($reason)) {
        echo "All fields are required!";
        exit;
    }

    // Insert appointment into the database
    $sql = "INSERT INTO doctor_appointments (patient_name, doctor_name, appointment_date, appointment_time, reason) 
            VALUES ('$patient_name', '$doctor_name', '$appointment_date', '$appointment_time', '$reason')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch and return doctor appointments as JSON
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT * FROM doctor_appointments ORDER BY appointment_date ASC");
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            "id" => $row["id"],
            "patient_name" => $row["patient_name"],
            "doctor_name" => $row["doctor_name"],
            "appointment_date" => $row["appointment_date"],
            "appointment_time" => $row["appointment_time"],
            "reason" => $row["reason"]
        ];
    }
    echo json_encode($appointments);
}

$conn->close();
?>
