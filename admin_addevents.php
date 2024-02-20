<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["event_name"];
    $start = $_POST["event_time"];

    // Check if the start date is from the last month, weeks, or days
    $currentDate = date("Y-m-d");
    $lastMonth = date("Y-m-d", strtotime("-1 month"));
    $lastWeek = date("Y-m-d", strtotime("-1 week"));
    $yesterday = date("Y-m-d", strtotime("-1 day"));

    if ($start < $lastMonth || $start < $lastWeek || $start < $yesterday) {
        $response = array("success" => false, "error" => "Cannot add events for past dates.");
    } else {
        $stmt = $conn->prepare("INSERT INTO events (title, start) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $start);
        try {
            $stmt->execute();
            $response = array("success" => true);
        } catch(Exception $e) {
            $response = array("success" => false, "error" => $e->getMessage());
        }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}
// Close the connection
$conn->close();
