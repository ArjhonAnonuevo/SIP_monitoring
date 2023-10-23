<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_info_db";  // Assuming you've created the database as 'user_info_db'

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Prepare and execute a SQL query to insert user information into the 'users' table
    $sql = "INSERT INTO users (username, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);

    if ($stmt->execute()) {
        echo "User information inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
