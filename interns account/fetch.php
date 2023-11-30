<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT interns_username FROM interns";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td class='px-5 py-3 border-b border-gray-200'>" . $row["interns_username"] . "</td></tr>";
    }
} else {
    echo "<tr><td class='px-5 py-3 border-b border-gray-200' colspan='1'>No usernames found</td></tr>";
}

// Close the database connection
$conn->close();
?>