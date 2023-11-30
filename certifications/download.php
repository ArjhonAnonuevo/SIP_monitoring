<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['user'])) {
    die("Username not found in query parameter");
}
$username = $_GET['user'];

// Prepare the query
$stmt = $conn->prepare("SELECT file_name, description, file_content FROM certifications WHERE user = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind the parameter
$stmt->bind_param("s", $username);

// Execute the query
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Bind the result variables
$stmt->bind_result($fileName, $description, $fileContent);

// Fetch the results
if ($stmt->fetch()) {
    // Set the appropriate headers for PDF file download
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=" . $fileName);

    // Output the file content
    echo $fileContent;
} else {
    die("No file found for the given username");
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
