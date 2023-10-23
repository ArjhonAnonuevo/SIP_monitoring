<?php
include "database.php"; // Include your database connection code
$dbname = "interns_application"; // Replace with your actual database name

if (isset($_GET['id']) && isset($_GET['type'])) {
    $applicant_id = $_GET['id'];
    $file_type = $_GET['type'];

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to retrieve file data from the database
    $query = "SELECT $file_type FROM files WHERE id = $applicant_id";

    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            // Get the file data based on the file type
            $file_data = $data[$file_type];

            // Check if the file data exists
            if ($file_data) {
                // Set the appropriate headers for the file download
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $file_type . '.pdf"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . strlen($file_data));
                echo $file_data;
                exit;
            } else {
                echo "<p class='text-red-500'>File not found.</p>";
            }
        } else {
            echo "<p class='text-red-500'>Applicant not found.</p>";
        }
    } else {
        echo "<p class='text-red-500'>Error executing query: " . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "<p class='text-red-500'>Invalid request.</p>";
}
?>
