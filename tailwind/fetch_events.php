<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, start, end FROM events";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $event = [
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start'],
            'end' => $row['end']
        ];
        $events[] = $event;
    }
}

header('Content-Type: application/json');
echo json_encode($events);

$conn->close();

?>
