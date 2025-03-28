<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mental_health_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized Treatment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4a90e2, #7b4397);
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .content {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            color: #333;
            max-width: 800px;
            margin: 50px auto;
            text-align: left;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #4a90e2;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
        }
        a:hover {
            background: #7b4397;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Personalized Treatment</h1>
        <p>Everyone's mental health journey is unique. Our platform provides personalized treatment plans tailored to your specific needs, ensuring that you get the best care possible.</p>
        <p>Start your personalized treatment today.</p>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>
<?php
$conn->close();
?>