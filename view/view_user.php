<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_info_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user's ID from the form submission
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Prepare and execute a SQL query to retrieve user information
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();

    // Fetch the user's information
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user_info = $result->fetch_assoc();

        // Display user information
        echo "<h2>User Information:</h2>";
        echo "User ID: " . $user_info["id"] . "<br>";
        echo "Username: " . $user_info["username"] . "<br>";
        echo "Email: " . $user_info["email"] . "<br>";
        // Add more fields as needed
    } else {
        echo "User not found";
    }

    // Close the database connection
    $stmt->close();
}

$conn->close();
?>
