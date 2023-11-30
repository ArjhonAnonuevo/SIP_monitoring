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

$fileNames = array();
while ($row = $result->fetch_assoc()) {
    $fileNames[] = $row['file_name'];
}
echo json_encode($fileNames);
$stmt->close();
$conn->close();
?>