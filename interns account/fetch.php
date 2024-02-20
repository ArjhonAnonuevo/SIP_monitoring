<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rowsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rowsPerPage;

// Execute SQL query to get the total number of rows
$totalRowsQuery = "SELECT COUNT(*) FROM interns ";
$totalRowsResult = mysqli_query($conn, $totalRowsQuery);

// Check for successful query execution
if (!$totalRowsResult) {
    die("Error in totalRowsQuery: " . mysqli_error($conn));
}

// Fetch the total number of rows from the result
$totalRows = mysqli_fetch_array($totalRowsResult)[0];

// Calculate the total number of pages
$totalPages = ceil($totalRows / $rowsPerPage);

$sql = "SELECT interns_username,fname,mname,lname FROM interns
LIMIT $offset, $rowsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='px-4 py-5 md:w-1/6'>" . $row["interns_username"] . "</td>";
        echo "<td class='px-4 py-5 md:w-1/6'>" . $row["fname"] . "</td>";
        echo "<td class='px-4 py-5 md:w-1/6'>" . $row["mname"] . "</td>";
        echo "<td class='px-4 py-5 md:w-1/6'>" . $row["lname"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td class='px-5 py-3 border-b border-gray-200' colspan='4'>No usernames found</td></tr>";
}
?>

</tbody>
</table>

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

<?php
// Close the database connection
$conn->close();
?>
