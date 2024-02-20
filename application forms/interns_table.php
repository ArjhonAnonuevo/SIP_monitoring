<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Applications</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php
session_start();

$username = isset($_GET["username"]) ? $_GET["username"] : (isset($_SESSION["username"]) ? $_SESSION["username"] : "Unknown");

include "../dashboard/admin_navs.php";

$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "interns_application";

$con = mysqli_connect($host, $user, $pass, $databaseName);

$rowsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rowsPerPage;

// Execute SQL query to get the total number of rows
$totalRowsQuery = "SELECT COUNT(*) FROM application";
$totalRowsResult = mysqli_query($con, $totalRowsQuery);

// Check for successful query execution
if (!$totalRowsResult) {
    die("Error in totalRowsQuery: " . mysqli_error($con));
}

// Fetch the total number of rows from the result
$totalRows = mysqli_fetch_array($totalRowsResult)[0];

// Calculate the total number of pages
$totalPages = ceil($totalRows / $rowsPerPage);

// Execute SQL query with LIMIT and OFFSET
$sql = "SELECT id, given_name, middle_name, family_name, primary_email,application_date, control_number
        FROM application
        LIMIT $offset, $rowsPerPage";
        

$result = mysqli_query($con, $sql);

// Check for successful query execution
if (!$result) {
    die("Error in SQL query: " . mysqli_error($con));
}

// Close the connection
mysqli_close($con);
?>
<div class = "md:ml-48 xl:ml-48 lg:48"> 
<div class="mx-auto md:max-w-7xl md:max-h-min bg-white shadow-md p-6 mt-8 rounded-md">
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-5">
        <h2 class="text-2xl font-bold mb-6 font-sans md:mb-0 md:text-3xl">Student Applications</h2>
        <button onclick="modalOpen('myModal')" class="bg-green-600 hover:bg-green-800 text-white font-sans font-bold py-2 px-4 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none transition duration-300 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed">
    Notify
</button>

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
    <div id="myModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 overflow-y-auto justify-center hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-lg mx-auto relative">
            <form action="process_email.php" method="post">
                <div class="modal-header p-6">
                    <button type="button" class="close-btn absolute top-0 right-0 p-4" onclick="modalClose('myModal')">
                        <!-- SVG for close icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0   0   24   24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6   18L18   6M6   6l12   12"></path>
                        </svg>
                    </button>
                    <h3 class="text-3xl font-bold text-green-700">New Message</h3>
                </div>
                <div class="modal-body p-6">
                    <div class="card-body">
                        <div class="compose-toolbar">
                            <label for="recipient" >To:</label>
                            <textarea id="recipients" name="primary_email" class="w-full h-32 border rounded-md p-2 mt-4 focus:outline-none focus:ring focus:ring-green-700 focus:border-green-700" readonly></textarea>
                        </div>
            
                        <h4 class="mb-2">Message: </h4>
                        <textarea class="w-full h-32 border rounded-md p-2 mt-4 focus:outline-none focus:ring focus:ring-green-700 focus:border-green-700" name="message" placeholder="Type your message here..."></textarea>
                        
                    </div>
                </div>
                <div class="modal-footer p-6 flex justify-end">
                    <button type="reset" class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded mr-4">Discard</button>
                    <button type="submit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded">Send</button>
                </div>
        </div>
    </div>
</div>
    <div class="bg-white shadow-md overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-green-700 text-white">
                    <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Applicant ID</th>
                    <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Control Number</th>
                    <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                    <th class="px-4 w-52 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Email</th>
                    <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Application Date</th>
                    <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Accept</th>
                    <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Reject</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $rowNumber = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $rowNumber++;
                        $zebraClass = $rowNumber % 2 === 0 ? 'bg-gray-100' : '';
                        echo "<tr class='$zebraClass'>";
                        echo "<td class='px-4 py-2 md:w-1/6 text-left'>" . "Applicant " . $row["id"] . "</td>";
                        echo "<td class='px-4 py-2 md:w-1/6 text-left'>" . $row["control_number"] . "</td>";
                        echo "<td class='px-4 py-4 md:w-1/6 text-left'>
                            <a href='display.php?id=" . $row["id"] . "&email=" . $row["primary_email"] . "&given_name=" . urlencode($row["given_name"]) . "' class='text-blue-500'>" . $row["given_name"] . " " . $row["middle_name"] . " " . $row["family_name"] . "</a>
                        </td>";
                        echo "<td class='px-4 py-2 md:w-1/6 text-left'>" . $row["primary_email"] . "</td>";
                        echo "<td class='px-10 py-2 md:w-1/6 text-right'>" . date('F j, Y', strtotime($row["application_date"])) . "</td>";
                        echo "<td class='px-4 py-2 md:w-1/6'>
                            <input type='checkbox' name='applicant_checkbox[]' value='" . $row["primary_email"] . "' class='h-5 w-5 text-blue-600 rounded-md focus:outline-none'>
                        </td>";
                        echo "<td class='px-4 py-2 md:w-1/6'>
                            <input type='checkbox' name='applicant_checkbox[]' value='" . $row["primary_email"] . "' class='h-5 w-5 text-blue-600 rounded-md focus:outline-none'>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td class='py-4 text-gray-900 font-semibold font-sans' colspan='6'>No results found.</td></tr>";
                }
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
<script>
    function modalOpen(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function modalClose(id) {
        document.getElementById(id).style.display = 'none';
    }

    document.querySelectorAll('[name="applicant_checkbox[]"]').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var recipientsTextarea = document.getElementById('recipients');
            if (this.checked) {
                recipientsTextarea.value += this.value + '\n';
            } else {
                var lines = recipientsTextarea.value.split('\n');
                var index = lines.indexOf(this.value);
                if (index > -1) {
                    lines.splice(index,  1);
                }
                recipientsTextarea.value = lines.join('\n');
            }
        });
    });

   // Existing filterTable function
function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchID");
    filter = input.value.toUpperCase();
    table = document.querySelector(".min-w-full");
    tr = table.getElementsByTagName("tr");

    for (i =  0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (var j =  0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}

// New sortTable function
function sortTable(n, asc = true) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount =  0;
    table = document.querySelector(".min-w-full");
    switching = true;
    dir = asc ? "asc" : "desc";
    
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i =  1; i < (rows.length -  1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i +  1].getElementsByTagName("TD")[n];
            
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i +  1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount ==  0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

// Event listeners for filter and sort dropdowns
document.getElementById("filterBy1").addEventListener("change", function() {
    filterTable();
});

document.getElementById("filterBy2").addEventListener("change", function() {
    var columnIndex = this.selectedIndex -  1; // Assuming the first option is empty or default
    sortTable(columnIndex, this.options[this.selectedIndex].getAttribute('data-order') !== 'desc');
});

</script>
</body>
</html>
