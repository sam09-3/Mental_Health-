<?php
include 'db_connect.php';  // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encrypt password

    // Insert data into database
    $sql = "INSERT INTO users (fullname, email, username, password) 
            VALUES ('$fullname', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.html'>Go to Login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
