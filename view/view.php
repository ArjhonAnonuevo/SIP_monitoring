<!DOCTYPE html>
<html>
<head>
    <title>User Information Viewer</title>
</head>
<body>
    <h1>User Information Viewer</h1>

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

    // Retrieve the user's ID from the URL
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        // Query the database to retrieve user information
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
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
    } else {
        echo "User ID not provided in the URL.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
