<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "interns_management";
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file2']) && $_FILES['file2']['error'] == 0) {
        $file_name = $_FILES['file2']['name'];
        $file_type = $_FILES['file2']['type'];
        $file_size = $_FILES['file2']['size'];
        $file_content = file_get_contents($_FILES['file2']['tmp_name']);
        
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null; 
        // Retrieve the value of 'submission_date' from 'previous_month_submission' table
        $stmt = $conn->prepare("SELECT submission_date FROM previous_month_submission WHERE user_details = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($submission_date);
        $stmt->fetch();
        $stmt->close();

        $current_month = date('F');

        $stmt = $conn->prepare("INSERT INTO month (file_name, file_type, file_size, file, month, current_month, username) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssibsss", $file_name, $file_type, $file_size, $file_content, $submission_date, $current_month, $username);

        if ($stmt->execute()) {
            echo '<script>';
            echo "alert('File uploaded successfully. " . $submission_date . "');";
            echo 'window.location.href = "reports.php";';
            echo '</script>';
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    echo "Invalid request.";
}
?>
