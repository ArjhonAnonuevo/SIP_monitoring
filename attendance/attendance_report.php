<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT interns_profile.id, interns_profile.name, interns_profile.mname, interns_profile.lname, interns_profile.department, interns_account.username
FROM interns_profile
JOIN interns_account ON interns_profile.id = interns_account.profile_id";

$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($conn));
}

$result = mysqli_stmt_execute($stmt);
if (!$result) {
    die("Query execution failed: " . mysqli_error($conn));
}

$data = array();
$result = mysqli_stmt_get_result($stmt);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Construct the "profile_id" field as "Applicant [id]"
        // $row['profile_id'] = $row['profile_id'];
        // unset($row['profile_id']); // Remove the 'id' field if you don't need it separately
        $data[] = $row;
    }
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);
?>
