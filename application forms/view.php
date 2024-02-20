<?php
include "database.php"; // Include your database connection code
$dbname = "interns_application"; // Replace with your actual database name

// Check if required parameters are provided
if (isset($_GET['applicant_id']) && isset($_GET['file_type'])) {
    $applicantId = $_GET['applicant_id'];
    $fileType = $_GET['file_type'];

     // Connect to the database
     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check the connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

    // Query to retrieve the PDF content based on applicant_id and file_type
    $query = "SELECT `$fileType` FROM files WHERE id = $applicantId";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            // Fetch the PDF content from the result
            $row = $result->fetch_assoc();
            $pdfContent = $row[$fileType];

            // Send the PDF content in the response
            header('Content-Type: application/pdf');
            echo $pdfContent;
        } else {
            echo "PDF not found for the given applicant.";
        }
    } else {
        echo "Error executing query: " . $connection->error;
    }
} else {
    echo "Invalid request. Missing parameters.";
}
// Close the database connection
$conn->close();
?>
