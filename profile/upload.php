<?php
// Check if a file was uploaded
if(isset($_FILES['profile'])) {
  $file = $_FILES['profile'];

  // Check for errors during file upload
  if($file['error'] === UPLOAD_ERR_OK) {
    $tempFilePath = $file['tmp_name'];
    $fileName = $file['name'];
    $uploadPath = 'interns_profile/' . $fileName;

    // Move the uploaded file to the desired folder
    if(move_uploaded_file($tempFilePath, $uploadPath)) {
      // File upload successful

      // Database connection details
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "interns_management";

      // Create a new mysqli instance
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check the connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Prepare the SQL statement to update the image filename in the database
      $stmt = $conn->prepare("UPDATE profile SET interns_profile = ?");

      // Bind the filename parameter to the prepared statement
      $stmt->bind_param("s", $fileName);

      // Execute the SQL statement
      if($stmt->execute()) {
        echo "File uploaded and updated in the database successfully!";
      } else {
        echo "Failed to update the file in the database.";
      }

      // Close the database connection
      $conn->close();
    } else {
      // Failed to move the uploaded file
      echo "Failed to move the uploaded file.";
    }
  } else {
    // Error during file upload
    echo "Error during file upload: " . $file['error'];
  }
} else {
  // No file was uploaded
  echo "No file uploaded.";
}
?>
