<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT ip.name, ip.mname, ip.lname, ip.department, ia.username
        FROM interns_profile ip
        JOIN interns_account ia ON ia.profile_id = ip.id";
$result = $conn->query($sql);

// Fetch the result and store it in an array
$data = array();
while ($row = $result->fetch_assoc()) {
    // Exclude the 'id' field from the row
    unset($row['id']);
    // Concatenate 'mname' and 'lname' into 'name'
    $row['name'] = $row['name'] . ' ' . $row['mname'] . ' ' . $row['lname'];
    $data[] = $row;
}

// Encode the data as JSON
$jsonData = json_encode($data);

// Output the JSON data
echo $jsonData;

?>
