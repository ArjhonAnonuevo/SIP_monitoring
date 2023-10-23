<?php
if(isset($_POST["submit"])) {
    $file = $_FILES["fileToUpload"]["tmp_name"];
    $file_name = $_FILES["fileToUpload"]["name"];
    $file_type = $_FILES["fileToUpload"]["type"];
    $file_size = $_FILES["fileToUpload"]["size"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fileupload";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $file_data = file_get_contents($file);

    $sql = "INSERT INTO files (name, type, size, data) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $file_name, $file_type, $file_size, $file_data);

    if ($stmt->execute()) {
        echo "File uploaded and inserted into the database successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
