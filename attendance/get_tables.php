<?php
include "db config.php";
$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$selectedMonth = $_GET['month']; // Updated to use 'month' parameter

// Perform a query to fetch tables for the selected month
$query = "SELECT * FROM attendance WHERE MONTH(attendance_date) = $selectedMonth";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    $lastDate = "";
    $tables = [];

    while ($row = $result->fetch_assoc()) {
        $date = new DateTime($row["attendance_date"]);
        $formattedDate = $date->format('F d, Y');

        // Add your HTML row generation here
        $tableRow = "<tr>";
        $tableRow .= "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['morning_timein'] . "</td>";
        $tableRow .= "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['lunch_timeout'] . "</td>";
        $tableRow .= "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['after_lunch_timein'] . "</td>";
        $tableRow .= "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['end_of_day_timeout'] . "</td>";
        $tableRow .= "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['attendance_date'] . "</td>";
        $tableRow .= "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['rendered_hours'] . "</td>";
        // $tableRow .= "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['total'] . "</td>";
        $tableRow .= "</tr>";

        // Store the HTML row in the $tables array
        $tables[] = $tableRow;

        $lastDate = $formattedDate;
    }

    if ($lastDate != "") {
        echo "<tbody></table></div>";
    }

    foreach ($tables as $table) {
        echo $table;
    }
} else {
    echo "<tbody><tr><td colspan='6' class='text-center items-center justify-center' style='font-family: Maitree, sans-serif;'>No records found.</td></tr></tbody>";
}

// Close the database connection
$connection->close();
?>
