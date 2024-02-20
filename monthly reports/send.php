<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST["description"];
    $message = $_POST["message"];
    $username = $_SESSION['username'];

    // Fetch the corresponding names from interns_profile table
    $fetchNamesQuery = "SELECT name, mname, lname FROM interns_profile WHERE ";
    $stmt = $conn->prepare($fetchNamesQuery);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($firstName, $middleName, $lastName);
    $stmt->fetch();
    $stmt->close();

    $date = date("Y-m-d");
    $time = date("H:i");

    $insertQuery = "INSERT INTO reports_request (description, message, username, first_name, middle_name, last_name, date, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ssssssss", $description, $message, $username, $firstName, $middleName, $lastName, $date, $time);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Values inserted successfully."); window.location.href = "reports.php";</script>';
    } else {
        echo '<script>alert("Error inserting values: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
}

$conn->close();
?>
