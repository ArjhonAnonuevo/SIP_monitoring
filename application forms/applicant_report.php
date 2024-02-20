<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_application";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the page number from the URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset
$offset = ($page - 1) * 10;

// Set the limit for the number of records to return
$limit = 10;

$query = "SELECT application.id, application.given_name, application.middle_name, application.family_name, application.primary_email
FROM application LIMIT $limit OFFSET $offset";

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
        $data[] = $row;
    }
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);
?>
