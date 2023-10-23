<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_application";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
$query = "SELECT id, given_name, middle_name, family_name FROM application";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Send the data as JSON to the front-end
header('Content-Type: application/json');
echo json_encode($data);

mysqli_close($connection);
?>
