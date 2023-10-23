<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fileupload";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the database to fetch file information
$sql = "SELECT id, name, type, size FROM files";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>List of Uploaded Files:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $fileID = $row["id"];
        $fileName = $row["name"];
        $fileType = $row["type"];
        $fileSize = $row["size"];

        // Display the file details and provide a download link
        echo "<li>";
        echo "File Name: $fileName<br>";
        echo "File Type: $fileType<br>";
        echo "File Size: $fileSize bytes<br>";
        echo "<a href='download.php?id=$fileID'>Download</a>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No files found.";
}

$conn->close();
?>
