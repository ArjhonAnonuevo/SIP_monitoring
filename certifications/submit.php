<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_GET["username"])) {
    $user = $_GET["username"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "interns_management";

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // Prepare the SQL statement to insert the uploaded file details
    $stmt = $conn->prepare("INSERT INTO certifications (file_name, description, file_content, user) VALUES (?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt) {
      // Bind the parameters
      $stmt->bind_param("ssss", $fileName, $description, $fileContent, $user);

      // Get the uploaded file details
      $fileName = $_FILES["files"]["name"][0];
      $description = $_POST["description"];
      $fileContent = file_get_contents($_FILES["files"]["tmp_name"][0]);

      // Execute the statement
      if ($stmt->execute()) {
        echo '<script>alert("File uploaded successfully."); window.location.href = "certifications.php";</script>';
      } else {
        echo "Error uploading file: " . $stmt->error;
      }

      // Close the statement
      $stmt->close();    } else {
      echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
  } else {
    echo "Username parameter is missing.";
  }
}
?>
