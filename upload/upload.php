<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "fileupload";

// Create a connection to the MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}


$conn->select_db($databaseName);

$sql = "CREATE TABLE IF NOT EXISTS files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'files' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}


$conn->close();
?>

<!DOCTYPE html>
<html>
    <body>
<form action="save.php" method="post" enctype="multipart/form-data">
    Select File: <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>
</body>
</html>
