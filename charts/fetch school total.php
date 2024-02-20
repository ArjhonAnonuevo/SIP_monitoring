<?php
require_once "../monthly reports/db config.php";

// Connect to the database
$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query to get data from the table
$query = "SELECT school, COUNT(*) as total FROM interns_profile GROUP BY school";

// Execute query
$result = $connection->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $connection->error);
}

// Loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

// Free memory associated with result
$result->close();

// Close connection
$connection->close();

// Print the data
echo json_encode($data);
?>
