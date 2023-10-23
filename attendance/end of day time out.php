<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database_name = 'interns_management';

// Create a database connection
$mysqli = new mysqli($hostname, $username, $password, $database_name);

if (isset($_POST['end_of_day_timeout'])) {
    $end_of_day_timeout = $_POST['end_of_day_timeout'];
    $attendance_date = date('Y-m-d'); 

    // Check if a record exists for the current date
    $sql_check = "SELECT id, morning_timein, lunch_timeout, after_lunch_timein FROM attendance WHERE attendance_date = ?";
    $stmt_check = $mysqli->prepare($sql_check);
    $stmt_check->bind_param("s", $attendance_date);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Record already exists for the current date, update the existing record with end of day time-out
        $sql_update = "UPDATE attendance SET end_of_day_timeout = ? WHERE attendance_date = ?";
        $stmt_update = $mysqli->prepare($sql_update);
        $stmt_update->bind_param("ss", $end_of_day_timeout, $attendance_date);

        if ($stmt_update->execute()) {
            // Data updated successfully, calculate the rendered hours
            $row = $result_check->fetch_assoc();
            $morning_timein = strtotime($row['morning_timein']);
            $lunch_timeout = strtotime($row['lunch_timeout']);
            $after_lunch_timein = strtotime($row['after_lunch_timein']);
            $end_of_day_timeout = strtotime($end_of_day_timeout);

            // Calculate the total hours worked
            $total_seconds_worked = $end_of_day_timeout - $morning_timein - ($lunch_timeout - $after_lunch_timein);

            // Cap the rendered hours at 8 hours (if the user timed in at 7 AM)
            $fixed_working_hours_7_to_4 = 8 * 3600; // 8 hours in seconds (7 AM to 4 PM)
            $fixed_working_hours_8_to_5 = 8 * 3600; // 9 hours in seconds (8 AM to 5 PM)
            
            if ($total_seconds_worked > $fixed_working_hours_7_to_4) {
                $total_seconds_worked = min($total_seconds_worked, $fixed_working_hours_8_to_5);
            } else {
                $total_seconds_worked = $fixed_working_hours_7_to_4;
            }

            $total_hours_worked = $total_seconds_worked / 3600; // Convert seconds to hours

            // Update the "rendered_hours" column in the database
            $sql_rendered_hours_update = "UPDATE attendance SET rendered_hours = ? WHERE attendance_date = ?";
            $stmt_rendered_hours_update = $mysqli->prepare($sql_rendered_hours_update);
            $stmt_rendered_hours_update->bind_param("ds", $total_hours_worked, $attendance_date);

            if ($stmt_rendered_hours_update->execute()) {
                // Rendered hours updated successfully, display a success alert and redirect
                echo "<script>alert('End of Day Time-Out recorded successfully for $attendance_date. Rendered hours updated.');";
                echo "window.location.href = 'attendance form.php';</script>";
            } else {
                // Error occurred while updating rendered hours, display an error alert and redirect
                echo "<script>alert('Error updating rendered hours: " . $stmt_rendered_hours_update->error . "');";
                echo "window.location.href = 'attendance.php';</script>";
            }

            $stmt_rendered_hours_update->close();
        } else {
            // Error occurred while updating data, display an error alert and redirect
            echo "<script>alert('Error updating End of Day Time-Out: " . $stmt_update->error . "');";
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