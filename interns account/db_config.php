<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS interns_management";
$conn->query($sql);
$conn->close();
// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, "interns_management");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create the interns_profile table
$sql = "CREATE TABLE IF NOT EXISTS interns_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    age INT,
    birthday DATE,
    contact_number VARCHAR(20) NOT NULL,
    school VARCHAR(255) NOT NULL,
    course VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    hours_required INT,
    emergency_contact VARCHAR(20) NOT NULL,
    start_date DATE NOT NULL
);
$conn->query($sql);
$sql = "CREATE TABLE IF NOT EXISTS interns_account (
    username VARCHAR(255) PRIMARY KEY NOT NULL,
    profile_id INT NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (profile_id) REFERENCES interns_profile(id)
)";
$conn->query($sql);
$conn->close();
?>