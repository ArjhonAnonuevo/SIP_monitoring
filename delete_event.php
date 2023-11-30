<?php
// Step 1: Retrieve the event ID from the form submission
if (isset($_POST['event_id'])) {
    $eventId = $_POST['event_id'];

    // Step 2: Perform the deletion operation
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "interns_management";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM events WHERE id = $eventId";
    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo '<script>alert("Event deleted successfully."); window.location.href = "admin_dashboard.php";</script>';
    } else {
        // Deletion failed
        echo '<script>alert("Error deleting event: ' . $conn->error . '");</script>';
    }

    $conn->close();
} else {
    // If the event ID is not set, display an error message or handle the error as needed
    echo '<script>alert("Error: Event ID not provided.");</script>';
}
?>
