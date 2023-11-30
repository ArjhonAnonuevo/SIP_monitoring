<?php
session_start();
// Check if the username is passed as a parameter
if (isset($_GET["username"])) {
    $username = $_GET["username"];
} else {
    // Check if the username is stored in the session
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    } else {
        // Handle the case when the username is not available
        $username = "Unknown"; // Set a default value
    }
}
include "../dashboard/admin_navs.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Interns Data</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet"> 
    <style>
        .hidden {
            display: none;
        }

        .p-4 {
            padding: 1rem;
        }

        .bg-gray-100 {
            background-color: #f9f9f9;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #ddd;
        }

        .search-container {
            margin-bottom: 1rem;
        }

        .search-input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px;
            width: 100%;
        }

        /* CSS rule to set the color of the links */
        .table a {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container mx-auto flex flex-col justify-center mt-10">
        <h2 class="text-2xl font-bold font-serif">Monthly reports</h2>
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search...">
        </div>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th class="px-5">Name</th>
                        <th class="p-4">Department</th>
                        <th class="p-4">SIP Number</th>
                    </tr>
                </thead>
                <tbody id="internsTable">
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Make an AJAX request to the PHP script
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'interns_report.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                populateTable(data);
            }
        };
        xhr.send();

        // Function to populate the table with data
        function populateTable(data) {
            var table = document.getElementById('internsTable');
            for (var i = 0; i < data.length; i++) {
                var row = table.insertRow(-1);
                var nameCell = row.insertCell(0);
                var departmentCell = row.insertCell(1);
                var usernameCell = row.insertCell(2);

                var nameLink = document.createElement('a');
                nameLink.textContent = data[i].name + " " + data[i].mname + " " + data[i].lname;;
                nameLink.href = 'display1.php?username=' + data[i].username;
                nameCell.appendChild(nameLink);

                departmentCell.innerHTML = data[i].department;
                usernameCell.innerHTML = data[i].username;
            }
        }
    </script>
</body>
</html>
