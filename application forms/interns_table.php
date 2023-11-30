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
    <title>Applicants Information</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #f8f9fa;
      }
      .container {
        margin-top: 8rem;
      }
    </style>
  </head>
  <body>
    <div class="container mx-auto">
      <div class="card-header">
        <h2 class="text-2xl font-bold mb-6 font-serif">Student Applications</h2>
      </div>
      <div class="card bg-white shadow-md rounded-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
          <div>
            <input type="text" class="form-input border border-solid border-gray-300 rounded-md p-2 w-full" id="searchID" placeholder="Search...." oninput="filterTable()">
          </div>
          <div class="col-span-2 mt-3">
            <button class="btn bg-green-900 text-white rounded-md w-32 h-10 hover:bg-green-700" onclick="resetTable()">Reset</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table-auto w-full">
            <thead>
              <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Applicant ID</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
              </tr>
            </thead>
            <tbody id="data-container"></tbody>
          </table>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        fetch('interns_info.php')
          .then(response => response.json())
          .then(data => {
            const dataContainer = document.getElementById('data-container');
            data.forEach(row => {
              const rowElement = document.createElement('tr');
              rowElement.innerHTML = `
       <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-base">${row.applicant_id}</td>
       <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-base">
       <a href="display.php?id=${row.applicant_id.replace('Applicant ', '')}&email=${row.primary_email}&given_name=${encodeURIComponent(row.given_name)}" class="text-blue-500 hover:underline">${row.given_name} ${row.middle_name} ${row.family_name}</a>
</td>

     <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-base">${row.primary_email}</td>
       `;
              dataContainer.appendChild(rowElement);
            });
          });
      });
      function resetTable() {
        document.getElementById('searchID').value = '';
        // Reload the page to reset all fields and data
        location.reload();
      }
      function filterTable() {
        const searchInput = document.getElementById('searchID').value.toLowerCase();
        const rows = document.querySelectorAll('#data-container tr');
        rows.forEach(row => {
          let match = false;
          row.querySelectorAll('td').forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchInput)) {
              match = true;
            }
          });
          if (match) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      }
    </script>
  </body>
</html>