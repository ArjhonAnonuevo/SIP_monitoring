<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve the username from the session
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  // SQL query to fetch files and file names based on the username
  $sql = "SELECT file, file_name FROM month WHERE username = '$username'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      // Display the file as an image
      echo "<span class='paragraph-l font-bold'>" . $row['file_name'] . "</span>";
    }
  } else {
    echo "0 results";
  }
} else {
  echo "Username not found in session";
}

$conn->close();
?>
