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
    <title>Attendance</title>
    <link href=" ../css/dist/tailwind.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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
    </style>
</head>
<body class = "bg-gray-100">
<div class="container mx-auto flex flex-col justify-center mt-10 bg-gray-100 p-4">
    <div class="py-8">
        <h2 class="text-2xl font-bold font-serif">Attendace Display</h2>
        <div class="shadow overflow-hidden rounded border-b border-gray-200">
        <div class="search-container">
        <input type="text" id="searchInput" class="search-input p-2 border border-gray-300 rounded-md">
        </div>
        <div class="overflow-x-auto">
            <table class="table table-sm shadow-lg bg-white border-collapse table-fixed border-2  w-full">
                <thead>
                    <tr class = "hover:bg-stone-100">
                        <th class="px-8 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Department</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SIP Number</th>
                    </tr>
                </thead>
                <tbody id="internsTable" class = "text-gray-600 text-sm font-light">
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div id="paginationContainer">
    <div class="flex justify-center">
  <button id="prevButton" class="border rounded-full text-gray-500 hover:bg-gray-200 hover:border-gray-200 bg-white" onclick="prevPage()">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
  </button>
  <button id="nextButton" class="border rounded-full text-gray-500 hover:bg-gray-200 hover:border-gray-200 bg-white" onclick="nextPage()">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
  </button>
</div>

    </div>

    <script>
    // Number of items per page
    var itemsPerPage = 10;

    // Current page number
    var currentPage = 1;

    // Function to paginate the data
    function paginate(data, itemsPerPage, currentPage) {
        var start = (currentPage - 1) * itemsPerPage;
        var end = start + itemsPerPage;
        return data.slice(start, end);
    }

    // Function to populate the table with data
    function populateTable(data) {
        var table = document.getElementById('internsTable');
        while (table.firstChild) {
            table.removeChild(table.firstChild);
        }
        var paginatedData = paginate(data, itemsPerPage, currentPage);
        for (var i = 0; i < paginatedData.length; i++) {
            var row = table.insertRow(-1);
            var nameCell = row.insertCell(0);
            nameCell.className = "border px-8 py-4";
            var departmentCell = row.insertCell(1);
            departmentCell.className = "border px-8 py-4";
            var usernameCell = row.insertCell(2);
            usernameCell.className = "border px-8 py-4";

            var nameLink = document.createElement('a');
            nameLink.className = "text-blue-700"
            nameLink.style.cssText = "font-family: 'Poppins', sans-serif;";
            nameLink.textContent = paginatedData[i].name + " " + paginatedData[i].mname + " " + paginatedData[i].lname;;
            nameLink.href = 'display.php?username=' + paginatedData[i].username; 
            nameCell.appendChild(nameLink);

            departmentCell.innerHTML = paginatedData[i].department;
            departmentCell.style.cssText = "font-family: 'Poppins', sans-serif;";
            usernameCell.innerHTML = paginatedData[i].username;
            usernameCell.style.cssText = "font-family: 'Poppins', sans-serif;";
        }
    }

    // Function to handle page changes
    function changePage(page) {
        currentPage = page;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'attendance_report.php?page=' + page, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
               var data = JSON.parse(xhr.responseText);
               populateTable(data);
            }
        };
        xhr.send();
    }

    // Function to handle search input
    searchInput.addEventListener('input', function() {
   var searchValue = searchInput.value.toLowerCase();
   var table = document.getElementById('internsTable');
   var rows = table.getElementsByTagName('tr');
   for (var i = 0; i < rows.length; i++) {
       var nameCell = rows[i].getElementsByTagName('td')[0];
       var departmentCell = rows[i].getElementsByTagName('td')[1];
       var usernameCell = rows[i].getElementsByTagName('td')[2]; // Get the username cell
       if (nameCell || departmentCell || usernameCell) { // Check if any of the cells exist
           var name = nameCell.textContent || nameCell.innerText;
           var department = departmentCell.textContent || departmentCell.innerText;
           var username = usernameCell.textContent || usernameCell.innerText; // Get the username
           if (name.toLowerCase().indexOf(searchValue) > -1 || department.toLowerCase().indexOf(searchValue) > -1 || username.toLowerCase().indexOf(searchValue) > -1) { // Check if any of the cells match the search input
               rows[i].style.display = '';
           } else {
               rows[i].style.display = 'none';
           }
       }
   }
});


    // Function to handle previous page button click
    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            changePage(currentPage);
        }
    }

    // Function to handle next page button click
    function nextPage() {
        currentPage++;
        changePage(currentPage);
    }

    // Load the first page
    changePage(currentPage);
 </script>
</body>
</html>
