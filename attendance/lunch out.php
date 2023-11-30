<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database_name = 'interns_management';

$mysqli = new mysqli($hostname, $username, $password, $database_name);

if (isset($_POST['lunch_timeout'])) {
    $lunch_timeout = $_POST['lunch_timeout'];
    date_default_timezone_set('Asia/Manila');
    $attendance_date = date('Y-m-d'); 

    // Check if a record exists for the current date
    $sql_check = "SELECT id FROM attendance WHERE attendance_date = ?";
    $stmt_check = $mysqli->prepare($sql_check);
    $stmt_check->bind_param("s", $attendance_date);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Update the existing record
        $sql_update = "UPDATE attendance SET lunch_timeout = ? WHERE attendance_date = ?";
        $stmt_update = $mysqli->prepare($sql_update);
        $stmt_update->bind_param("ss", $lunch_timeout, $attendance_date);

        if ($stmt_update->execute()) {
            echo "<script>alert('Lunch Time-Out updated successfully for $attendance_date.');";
            echo "window.location.href = 'attendance form.php';</script>";
        } else {
            echo "<script>alert('Error updating Lunch Time-Out: " . $stmt_update->error . "');";
            echo "window.location.href = 'attendance form.php';</script>";
        }

        $stmt_update->close();
    } else {
        // Insert a new record
        $sql_insert = "INSERT INTO attendance (lunch_timeout, attendance_date) VALUES (?, ?)";
        $stmt_insert = $mysqli->prepare($sql_insert);
        $stmt_insert->bind_param("ss", $lunch_timeout, $attendance_date);

        if ($stmt_insert->execute()) {
            echo "<script>alert('Lunch Time-Out recorded successfully for $attendance_date.');";
            echo "window.location.href = 'attendance form.php';</script>";
        } else {
            echo "<script>alert('Error inserting Lunch Time-Out: " . $stmt_insert->error . "');";
            echo "window.location.href = 'attendance form.php';</script>";
        }

        $stmt_insert->close();
    }
}

$mysqli->close();
