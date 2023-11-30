<!DOCTYPE html>
<html>
  <head>
    <title>Applicants Information</title>

    <!-- <link href="../css/dist/bootstrap.min.css" rel="stylesheet">  -->

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> -->

    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #f8f9fa;
      }
      .search-input {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px;
        width: 100%;
      }
      .table th,
      .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
      }
    </style>
  </head>
  <body class="bg-gray-100">
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
    <div class="container mx-auto flex flex-col justify-center mt-7">
      <div class="py-8">
        <h2 class="text-2xl font-bold font-serif">Attendace Display</h2>
        <div class="shadow overflow-hidden rounded border-b border-gray-200">
          <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search...">
          </div>
          <div class="overflow-x-auto">
            <table class="table-auto w-full">
              <thead>
                <tr>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Department</th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Username</th>
                  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody id="data-container" class="hover:bg-gray-200">
              </tbody>
            </table>
          </div>
        </div>
        <script>
          function resetTable() {
            document.getElementById('searchName').value = '';
            // Reload the page to reset all fields and data
            location.reload();
          }
          function filterTable() {
            const searchValue = document.getElementById('searchName').value.toLowerCase();
            const rows = document.querySelectorAll('#data-container tr');
            rows.forEach(row => {
              const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
              const department = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
              if (name.includes(searchValue) || department.includes(searchValue)) {
                row.style.display = '';
              } else {
                row.style.display = 'none';
              }
            });
          }
          // Make an AJAX request to fetch the data from the PHP script
          var xhr = new XMLHttpRequest();
          xhr.open('GET', 'interns_name.php', true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
              var jsonData = JSON.parse(xhr.responseText);
              displayData(jsonData);
            }
          };
          xhr.send();
          // Function to display the data in a table
          function displayData(data) {
            var container = document.getElementById('data-container');
            data.forEach(function(rowData) {
              var row = document.createElement('tr');
              // Create a new object to store the modified row data
              var modifiedRowData = {
                name: rowData.name,
                department: rowData.department,
                sip_number: rowData.username,
                // actions: rowData.actions
              };
              Object.entries(modifiedRowData).forEach(function([key, value]) {
                var cell = document.createElement('td');
                cell.textContent = value;
                cell.className = "border px-8 py-3";
                row.appendChild(cell);
              });
              var actionsCell = document.createElement('td');
              var viewButton = document.createElement('button');
              viewButton.textContent = 'View';
              viewButton.className = 'btn bg-green-900 rounded text-white md:w-20';
              // Pass the username as a parameter to the event listener function
              viewButton.addEventListener('click', function() {
                var username = rowData.username;
                redirectToCertificationsForm(username);
              });
              actionsCell.appendChild(viewButton);
              row.appendChild(actionsCell);
              container.appendChild(row);
            });
          }
          // Function to redirect to the certifications form with the username as a parameter
          function redirectToCertificationsForm(username) {
            window.location.href = `upload.php?username=${encodeURIComponent(username)}`;
          }
        </script>
  </body>
</html>