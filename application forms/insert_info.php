<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "interns_application";

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $primary_email = $_POST["primary_email"];

    // Validate primary email
    if (!filter_var($primary_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid primary email format";
        exit;
    }

    $sql_check = "SELECT * FROM application WHERE primary_email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $primary_email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo '<script>alert("You have already responded.");</script>';
        echo '<script>window.location.href = "responded.php";</script>';
        exit;
    }

    $given_name = $_POST["given_name"];
    $middle_name = $_POST["middle_name"];
    $family_name = $_POST["family_name"];
    $address = $_POST["address"];
    $place_birth = $_POST["place_birth"];
    $birthday = $_POST["birthday"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $contact = $_POST["contact"];
    $landline = $_POST["landline"];
    $secondary_email = $_POST["secondary_email"];

    // Validate required fields
    if (empty($given_name) || empty($family_name) || empty($address) || empty($place_birth) || empty($birthday) || empty($age) || empty($gender) || empty($contact) || empty($primary_email)) {
        echo "Please fill in all required fields";
        exit;
    }

    // Validate age
    if (!is_numeric($age) || $age < 0) {
        echo "Invalid age";
        exit;
    }

    // Validate contact number
    if (!preg_match("/^[0-9]{10}$/", $contact)) {
        echo "Invalid contact number";
        exit;
    }

    // Validate landline number (optional)
    if (!empty($landline) && !preg_match("/^[0-9]{7,}$/", $landline)) {
        echo "Invalid landline number";
        exit;
    }

    // Validate secondary email (optional)
    if (!empty($secondary_email) && !filter_var($secondary_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid secondary email format";
        exit;
    }

    $sql = "INSERT INTO application (given_name, middle_name, family_name, address, place_birth, birthday, age, gender, contact, landline, primary_email, secondary_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssss",
        $given_name,
        $middle_name,
        $family_name,
        $address,
        $place_birth,
        $birthday,
        $age,
        $gender,
        $contact,
        $landline,
        $primary_email,
        $secondary_email
    );

    if ($stmt->execute()) {
        echo "Application submitted successfully";
    } else {
        echo "Error inserting into application table: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
