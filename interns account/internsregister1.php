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
    gender VARCHAR(10) NOT NULL,
    age INT,
    birthday DATE,
    contact_number VARCHAR(20) NOT NULL,
    school VARCHAR(255) NOT NULL,
    course VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    hours_required INT,
    emergency_contact VARCHAR(20) NOT NULL
)";
$conn->query($sql);

// Create the interns_account table with a foreign key reference
$sql = "CREATE TABLE IF NOT EXISTS interns_account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (profile_id) REFERENCES interns_profile(id)
)";
$conn->query($sql);
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Registration</h2>
            </div>
            <div class="card-body">
                <form id="registration-form" action="register_process.php" method="post">
                    <!-- Page 1: Personal Information -->
                    <div class="form-page" id="page-1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" id="age" name="age" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" id="birthday" name="birthday" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="tel" id="contact-number" name="contact-number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="school">School</label>
                            <input type="text" id="school" name="school" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="course">Course</label>
                            <input type="text" id="course" name="course" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-primary next-page" data-next="page-2">Next</button>
                    </div>
<!-- Page 2: Additional Information -->
<div class="form-page" id="page-2" style= "display: none;">
    <div class="form-group">
        <label for="department">Designated Department</label>
        <input type="text" id="department" name="department" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="hours-required">Hours Required</label>
        <input type="number" id="hours-required" name="hours-required" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="emergency-contact">Emergency Contact</label>
        <input type="tel" id="emergency-contact" name="emergency-contact" class="form-control" required>
    </div>
    <button type="button" class="btn btn-secondary prev-page" data-prev="page-1">Previous</button>
    <button type="button" class="btn btn-primary next-page" data-next="page-3">Next</button>
</div>

<!-- Page 3: Username and Password -->
<div class="form-page" id="page-3" style="display: none;">
    <div class="form-group">
        <label for="id_name">Username</label>
        <input type="text" id="username" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" class="form-control" required>
    </div>
    <button type="button" class="btn btn-secondary prev-page" data-prev="page-2">Previous</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

                </form>
            </div>
        </div>
    </div>
    <script src="register.js"></script>
</body>
</html>