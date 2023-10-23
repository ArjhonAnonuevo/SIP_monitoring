<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS month (
     file_id INT NOT NULL AUTO_INCREMENT,
     file_name VARCHAR(255),
     file_type VARCHAR(255),
     file_size INT(50),
     file LONGBLOB,
     month VARCHAR(50),
     current_month DATE,
     username VARCHAR(255),
     PRIMARY KEY (file_id),
     FOREIGN KEY (username) REFERENCES interns_account(username)
)";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
