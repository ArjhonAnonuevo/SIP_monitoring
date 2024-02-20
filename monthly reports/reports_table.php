<?php
session_start();

// Prevent Cross-Site Scripting (XSS) Attacks
$username = isset($_GET["username"]) ? htmlspecialchars($_GET["username"], ENT_QUOTES, 'UTF-8') : null;

if (!$username && isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $username = "Unknown";
}

include "../dashboard/admin_navs.php";

// Connect to your database here
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "interns_management";

// Create a new database connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rowsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

$offset = ($page - 1) * $rowsPerPage;

$totalRowsQuery = "SELECT COUNT(*) FROM interns_profile";
$totalRowsResult = $conn->query($totalRowsQuery);

if (!$totalRowsResult) {
    die("Error fetching total rows: " . $conn->error);
}

$totalRows = $totalRowsResult->fetch_assoc()["COUNT(*)"];
$totalPages = ceil($totalRows / $rowsPerPage);

// Your SQL query goes here
$sql = "SELECT ip.name, ip.mname, ip.lname, ip.department, ia.username
        FROM interns_profile ip
        JOIN interns_account ia ON ia.profile_id = ip.id
        LIMIT $offset, $rowsPerPage";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Reports</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class = "md:ml-48 xl:ml-48 lg:ml-48">
    <div class="mx-auto md:max-w-7xl bg-white shadow-md p-6 mt-8 rounded-md ">
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-5">
        <h2 class="text-2xl font-bold mb-6 font-sans md:mb-0 md:text-3xl">Monthly Reports</h2>
    </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
            <div class="relative">
                <input type="text" class="border border-solid border-gray-300 rounded-md p-2 pl-8 w-full md:w-md" id="searchID" placeholder="Search...." oninput="filterTable()">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5-5m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex gap-4 justify-end">
                <select id="filterBy1" name="filterBy" class="mt-1 block w-full md:w-sm border border-solid border-gray-300 rounded-md p-2 text-gray-700 font-semibold">
                    <option value="name">Filter By</option>
                    <option value="category">Category</option>
                    <option value="date">Date</option>
                </select>
                <select id="filterBy2" name="filterBy" class="mt-1 block w-full md:w-sm border border-solid border-gray-300 rounded-md p-2 text-gray-700 font-semibold">
                    <option value="" data-order="asc">Sort By</option>
                    <option value="category" data-order="asc">Category</option>
                    <option value="date" data-order="asc">Date</option>
                </select>
            </div>
        </div>
        <div class="bg-white shadow-md overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-green-700 text-white">
                        <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wide">Name</th>
                        <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Department</th>
                        <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Sip number</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 font-light">

                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='px-4 py-2 md:w-1/6 text-left' style='font-family: \"Poppins\", sans-serif;'><a href='upload.php?username=" . urlencode($row['username']) . "' class='text-blue-700'>" . $row['name'] . " " . $row['mname'] . " " . $row['lname'] . "</a></td>";
                        echo "<td class='py-4 p-2 uppercase' style='font-family: \"Poppins\", sans-serif;'>" . $row['department'] . "</td>";
                        echo "<td class='px-4 py-2 md:w-1/6 text-left' style='font-family: \"Poppins\", sans-serif;'>" . $row['username'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found.</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-end space-x-2 text-sm mt-4">
            <?php if ($page > 1) : ?>
                <a href="?page=<?php echo $page - 1; ?>" title="previous" class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-600 rounded-md shadow">
                    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-4">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
            <?php endif; ?>

            <span class="text-gray-600">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

            <?php if ($page < $totalPages) : ?>
                <a href="?page=<?php echo $page + 1; ?>" title="next" class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-600 rounded-md shadow">
                    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-4">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
