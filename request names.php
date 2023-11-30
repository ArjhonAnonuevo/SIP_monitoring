<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'interns_management';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT interns_profile.name, interns_account.username
FROM interns_profile
JOIN interns_account ON interns_profile.id = interns_account.profile_id
INNER JOIN reports_request ON interns_account.username = reports_request.username
";

$result = mysqli_query($connection, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$json_result = json_encode($data);
echo $json_result;
mysqli_close($connection);

?>
