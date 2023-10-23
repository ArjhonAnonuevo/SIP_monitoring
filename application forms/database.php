<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if($conn->connect_error){
    die("Connection failed: " .$conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS interns_application";

$conn -> query($sql);