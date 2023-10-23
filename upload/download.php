<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fileupload";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $fileID = $_GET["id"];

    // Retrieve the file data from the database
    $sql = "SELECT name, type, size, data FROM files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $fileID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($fileName, $fileType, $fileSize, $fileData);
        $stmt->fetch();

        // Send the file for download
        header("Content-type: $fileType");
        header("Content-length: $fileSize");
        header("Content-disposition: attachment; filename=\"$fileName\"");
        echo $fileData;
    } else {
        echo "File not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
