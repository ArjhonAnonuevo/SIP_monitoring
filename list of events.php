<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, start FROM events"; 
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Add the font link here
echo '<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventId = $row["id"];
        $eventTitle = $row["title"];
        $eventDate = $row["start"]; 

        echo '<div class="bg-gray-100 p-4 mb-4 rounded-md">';
        echo "<h3 class='text-xl font-bold mb-2 font-serif'>$eventTitle</h3>";
        echo "<p class='text-gray-500 mb-1 font-serif'>Date: $eventDate</p>";
        echo "<form method='POST' action='delete_event.php'>";
        echo "<input type='hidden' name='event_id' value='$eventId'>";
        echo "<button type='submit' class='bg-red-600 text-white font-bold py-2 px-4 rounded-md mt-2'>Delete</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "No events found.";
}

// Step 4: Close the database connection
$conn->close();
?>
