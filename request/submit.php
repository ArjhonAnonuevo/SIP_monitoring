<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $selectedMonth = $_POST['selectedMonth'] ?? '';

    if (empty($username)) {
        die("Error: Username cannot be empty");
    }

    $months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    $selectedMonth = ucfirst(strtolower(trim($selectedMonth))); 

    if (!in_array($selectedMonth, $months)) {
        die("Error: Invalid selected month");
    }

    $conn = new mysqli("localhost", "root", "", "interns_management");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO previous_month_submission (user_details, submission_date) VALUES (?, ?)");

    if (!$stmt) {
        die("Error: Failed to prepare statement");
    }

    $stmt->bind_param("ss", $username, $selectedMonth);

    if ($stmt->execute()) {
        echo '<script>';
        echo 'alert("Record inserted successfully");';
        echo 'window.location.href = "request history.php";';
        echo '</script>';
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: Invalid request method";
}
?>
