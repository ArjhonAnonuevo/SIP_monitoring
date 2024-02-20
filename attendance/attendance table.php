<?php
require_once "../monthly reports/db config.php";
$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if username is set in the session
if (!isset($_SESSION['username'])) {
    // Redirect or handle the case where the username is not set in the session
    header("Location: ../interns account/login.php"); // Redirect to login page
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT * FROM attendance WHERE username = ?";
$totalHours = 0;

if ($stmt = mysqli_prepare($connection, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Attendance Table</title>
        <link href="../css/dist/tailwind.min.css" rel="stylesheet"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Istok+Web">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Overpass">
    </head>
    <body class="font-sans bg-gray-100">
        <section class="py-8 bg-blueGray-50">
            <div class="container mx-auto">
                <div class="bg-white p-8 rounded-md shadow-md">
                    <div class="flex sm:flex-col items-center justify-between mb-6">
                        <h3 class="text-2xl font-semibold text-blueGray-700" style="font-family: 'Montserrat', sans-serif;">Attendance Record</h3>
                        <div class="flex items-center mt-4 md:mt-0">
                            <select id="month" name="month" onchange="checkMonthSelection(this)" class="form-select w-48 px-4 py-2 border rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" style='font-family: Maitree, sans-serif;'>
                                <option value="">Select Month</option>
                                <?php
                                $selected_month = date('m'); //current month
                                for ($i_month = 1; $i_month <= 12; $i_month++) {
                                    $timestamp = mktime(0, 0, 0, $i_month, 1); // Create a timestamp for the first day of the month
                                    $selected = $selected_month == $i_month ? ' selected' : '';
                                    echo '<option value="' . $i_month . '"' . $selected . '>(' . $i_month . ') ' . date('F', $timestamp) . '</option>' . "\n";
                                }
                                ?>
                            </select>
                            <button class="ml-4 px-6 py-3 bg-green-800 text-white rounded-md font-bold">Generate PDF</button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="attendanceTable" class="w-full table-auto divide-y divide-gray-200">
                            <!-- Table headers -->
                            <thead>
                                <tr class="bg-green-700 text-white">
                                    <th class="px-6 py-3 text-xs uppercase font-semibold text-left">Morning Time In</th>
                                    <th class="px-6 py-3 text-xs uppercase font-semibold text-left">Lunch Time out</th>
                                    <th class="px-6 py-3 text-xs uppercase font-semibold text-left">After lunch Time In</th>
                                    <th class="px-6 py-3 text-xs uppercase font-semibold text-left">End of the day Time Out</th>
                                    <th class="px-6 py-3 text-xs uppercase font-semibold text-left">Attendance date</th>
                                    <th class="px-6 py-3 text-xs uppercase font-semibold text-left">Rendered Hours</th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                <?php
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td class='py-2 px-4'>" . $row['morning_timein'] . "</td>";
                                        echo "<td class='py-2 px-4'>" . $row['lunch_timeout'] . "</td>";
                                        echo "<td class='py-2 px-4'>" . $row['after_lunch_timein'] . "</td>";
                                        echo "<td class='py-2 px-4'>" . $row['end_of_day_timeout'] . "</td>";
                                        echo "<td class='py-2 px-4'>" . $row['attendance_date'] . "</td>";

                                        // Convert time to hours
                                        $renderedHours = intval(substr($row['rendered_hours'], 0, 2));

                                        // Display rendered hours
                                        echo "<td class='py-2 px-4'>" . $renderedHours . "</td>";
                                        $totalHours += $renderedHours; // Move the calculation inside the loop
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='py-2 px-4'>No attendance records found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <span class="text-xl font-semibold text-blueGray-700" style="font-family: 'Montserrat', sans-serif;">Total Rendered Hours: <?php echo $totalHours; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        // include "../tailwind/footers.html";
        ?>
        <script src="script.js"></script>
    </body>
    </html>

    <?php
} else {
    echo "Error preparing statement: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
