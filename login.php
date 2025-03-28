<?php
include 'db_connect.php';  // Include database connection
session_start();  // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Fetch user from database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["username"];
            header("Location: index.html"); // Redirect to homepage
            exit();
        } else {
            echo "Incorrect password. <a href='login.html'>Try Again</a>";
        }
    } else {
        echo "User not found. <a href='registration.html'>Register Here</a>";
    }
}

$conn->close();
?>
