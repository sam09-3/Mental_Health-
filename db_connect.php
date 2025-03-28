<?php
$servername = "localhost";  // Change if using a remote server
$username = "root";  // Default XAMPP username
$password = "";  // Default XAMPP password (leave blank if no password)
$dbname = "mental_health_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
