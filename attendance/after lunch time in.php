<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database_name = 'interns_management';

// Create a database connection
$mysqli = new mysqli($hostname, $username, $password, $database_name);

if (isset($_POST['after_lunch_timein'])) {
    $after_lunch_timein = $_POST['after_lunch_timein'];
    $attendance_date = date('Y-m-d'); // Get the current date

    // Check if a record exists for the current date
    $sql_check = "SELECT id FROM attendance WHERE attendance_date = ?";
    $stmt_check = $mysqli->prepare($sql_check);
    $stmt_check->bind_param("s", $attendance_date);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Record already exists for the current date, update the existing record with after lunch time-in
        $sql_update = "UPDATE attendance SET after_lunch_timein = ? WHERE attendance_date = ?";
        $stmt_update = $mysqli->prepare($sql_update);
        $stmt_update->bind_param("ss", $after_lunch_timein, $attendance_date);

        if ($stmt_update->execute()) {
            // Data updated successfully, display a success alert and redirect
            echo "<script>alert('After Lunch Time-In updated successfully for $attendance_date.');";
            echo "window.location.href = 'attendance form.php';</script>";
        } else {
            // Error occurred while updating data, display an error alert and redirect
            echo "<script>alert('Error updating After Lunch Time-In: " . $stmt_update->error . "');";
            echo "window.location.href = 'attendance form.php';</script>";
        }

        $stmt_update->close();
    } else {
        // No record found for the current date, display an alert and redirect
        echo "<script>alert('No record found for $attendance_date. Please submit your morning time-in first.');";
        echo "window.location.href = 'attendance form.php';</script>";
    }
}

// Close the database connection
$mysqli->close();
?>
