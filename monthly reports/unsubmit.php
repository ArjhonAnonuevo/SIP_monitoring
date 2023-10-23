<?php
session_start();
$username = $_SESSION['username'];
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "interns_management";
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT file_name FROM month WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fileName = $row["file_name"];
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM month WHERE username = ?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        unlink($fileName); 
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "No files found for the user";
}
$conn->close();
?>
