<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_application";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function getUserDataAndFiles($userId, $connection) {
    $userDataQuery = "SELECT * FROM application WHERE id = $userId";
    $userDataResult = mysqli_query($connection, $userDataQuery);

    $userFilesQuery = "SELECT f.*, fn.* FROM files f
                      JOIN file_names fn ON f.file_id = fn.file_id
                      WHERE f.id = $userId";
    $userFilesResult = mysqli_query($connection, $userFilesQuery);

    $data = array();

    if ($userDataResult && $userFilesResult) {
        $data['user'] = mysqli_fetch_assoc($userDataResult);
        $data['files'] = mysqli_fetch_assoc($userFilesResult);
    }

    return $data;
}

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $data = getUserDataAndFiles($userId, $connection);

    // Send the data as JSON to the front-end
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "User ID not provided.";
}
?>
