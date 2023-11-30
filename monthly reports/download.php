<?php
if (isset($_GET['username'])) {
    $input_username = $_GET['username'];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "interns_management";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT file, file_name FROM month WHERE username = '$input_username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_data = $row['file'];
        $filename = $row['file_name'];

        // Set the appropriate content type for PDF
        header('Content-Type: application/pdf');
        // Set the appropriate content disposition to force the browser to download the file with the original filename
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Output the binary data
        echo $file_data;
    } else {
        echo "No file found for the given username.";
    }

    $conn->close();
} else {
    echo "Username parameter is missing.";
}
?>
