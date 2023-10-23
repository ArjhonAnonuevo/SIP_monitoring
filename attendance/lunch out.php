<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database_name = 'interns_management';

$mysqli = new mysqli($hostname, $username, $password, $database_name);
if (isset($_POST['lunch_timeout'])) {
    $lunch_timeout = $_POST['lunch_timeout'];
    $attendance_date = date('Y-m-d'); 


    $sql_check = "SELECT id FROM attendance WHERE attendance_date = ?";
    $stmt_check = $mysqli->prepare($sql_check);
    $stmt_check->bind_param("s", $attendance_date);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
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
        echo "<script>alert('No record found for $attendance_date. Please submit your morning time-in first.');";
        echo "window.location.href = 'attendance form.php';</script>";
    }
}
$mysqli->close();
?>
