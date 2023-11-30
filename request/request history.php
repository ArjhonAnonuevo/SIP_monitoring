<?php
session_start();

include "../dashboard/admin_navs2.php";

$server = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the request history
$fetchHistoryQuery = "SELECT id, first_name, middle_name, last_name, description, date, time, username FROM reports_request ORDER BY date DESC";
$stmt = $conn->prepare($fetchHistoryQuery);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->execute();
$stmt->bind_result($id, $first_name, $middle_name, $last_name, $description, $date, $time, $username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/dist/tailwind.min.css" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro&display=swap" rel="stylesheet">
    <title>Request</title>
</head>
<body class="bg-gray-200">
    <div class="rounded-lg shadow-xl bg-white prose">
        <header class="font-semibold text-sm py-3 px-4 md:text-2xl font-serif" >
            Request History
        </header>
        <div class="p-4">
            <div class="flex mb-4">
                <label for="month" class="mr-2" style = "font-family: 'Montseratt', sans-serif;">Filter by Month:</label>
                <select id="month" class="border border-gray-300 rounded px-2 py-1" onchange="filterByMonth(this.value)">
                    <option value="">All</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                    <!-- Add more options for other months -->
                </select>
            </div>
        </div>
        <div class="p-4">
            <?php
            // Loop through the fetched history entries and display them
            while ($stmt->fetch()) {
                ?>
                <div class="border-b border-gray-300 pb-4 history-entry" data-month="<?php echo $date; ?>">
                    <div class="font-bold" style = "font-family: 'Montseratt', sans-serif;">
                    <a href="message.php?username=<?php echo urlencode($username); ?>&id=<?php echo $id; ?>">
                            <?php echo $first_name . " " . $middle_name . " " . $last_name; ?>
                        </a>
                    </div>
                    <p class="text-gray-600 " style = "font-family: 'Cabin', sans-serif;">Description: <?php echo $description; ?></p>
                    <div class="text-gray-500 text-sm" style = "font-family: 'Maven Pro', sans-serif;">Sent on <?php echo $date; ?> at <?php echo $time; ?></div>
                </div>
                <?php
            }
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
    <script>
        function filterByMonth(month) {
            var entries = document.getElementsByClassName("history-entry");
            for (var i = 0; i < entries.length; i++) {
                var entry = entries[i];
                var entryMonth = entry.getAttribute("data-month");
                if (month === "" || entryMonth === month) {
                    entry.style.display = "block";
                } else {
                    entry.style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
