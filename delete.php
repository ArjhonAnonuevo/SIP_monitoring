<?php
if (isset($_POST['username'])) {
    $userToDelete = $_POST['username'];

    $servername = "localhost";
    $dbUsername = "root";
    $password = "";
    $dbname = "interns_management";

    // Create a new mysqli instance
    $conn = new mysqli($servername, $dbUsername, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the delete query
    $query = "DELETE FROM reports_request WHERE username = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param('s', $userToDelete);
    $success = $stmt->execute();

    if ($success) {
        $response = array(
            'success' => true
        );
    } else {
        $response = array(
            'success' => false,
            'error' => 'Failed to delete data from the database.'
        );
    }
    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'error' => 'Invalid request. Username parameter is missing.'
    );

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
