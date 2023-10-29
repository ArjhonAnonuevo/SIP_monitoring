<?php
session_start();
if (!isset($_SESSION['username'])) {
    die("User not authenticated.");
}
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "interns_management";
// Create a database connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Use prepared statements to prevent SQL injection
$username = $_SESSION['username'];
$sql = "SELECT ip.name, ip.department, a.morning_timein, a.lunch_timeout, a.after_lunch_timein, a.end_of_day_timeout, a.attendance_date, a.rendered_hours
        FROM interns_profile ip
        JOIN interns_account ia ON ip.id = ia.profile_id
        JOIN attendance a ON ia.username = a.username
        WHERE ia.username = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
mysqli_close($conn);
?>