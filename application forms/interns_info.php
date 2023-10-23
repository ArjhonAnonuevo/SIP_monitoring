<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_application";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Execute the SQL query
$query = "SELECT a.id, a.given_name, a.middle_name, a.family_name, a.primary_email FROM application a";

$result = mysqli_query($conn, $query);
$data = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Construct the "applicant_id" field as "Applicant [id]"
        $row['applicant_id'] = "Applicant " . $row['id'];
        unset($row['id']); // Remove the 'id' field if you don't need it separately
        $data[] = $row;
    }
}

// Step 4: Close the database connection
mysqli_close($conn);

// Step 5: Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
