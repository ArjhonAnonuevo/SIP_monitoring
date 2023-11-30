<?php
// Replace with your actual database credentials
$hostname = 'localhost';
$username = 'root';
$password = '';
$database_name = 'interns_management';

// Start the session
session_start();

// Create a database connection
$mysqli = new mysqli($hostname, $username, $password, $database_name);

if (isset($_POST['morning_timein'])) {
    $morning_timein = $_POST['morning_timein'];
    date_default_timezone_set('Asia/Manila');
    $attendance_date = date('Y-m-d'); // Get the current date
    $username = $_SESSION['username']; // Get the username from the session

    $morning_timestamp = strtotime($morning_timein);
    
    // Check if a record exists for the current date and username
    $sql_check = "SELECT id FROM attendance WHERE attendance_date = ? AND username = ?";
    $stmt_check = $mysqli->prepare($sql_check);
    $stmt_check->bind_param("ss", $attendance_date, $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "<script>alert('You have already submitted Morning Time-In for $attendance_date.');";
        echo "window.location.href = 'attendance form.php';</script>";
    } else {
        // Insert a new record for the current date with morning time-in and username
        $sql_insert = "INSERT INTO attendance (morning_timein, attendance_date, username) VALUES (?, ?, ?)";
        $stmt_insert = $mysqli->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $morning_timein, $attendance_date, $username);

        if ($stmt_insert->execute()) {
            echo "<script>alert('Morning Time-In recorded successfully for $attendance_date.');";
            echo "window.location.href = 'attendance form.php';</script>";  
        } else {
            echo "<script>alert('Error inserting Morning Time-In: " . $stmt_insert->error . "');";
            echo "window.location.href = 'attendance form.php';</script>";
        }

        $stmt_insert->close();
    }
    else{
        
    }
}
$mysqli->close();
?>
