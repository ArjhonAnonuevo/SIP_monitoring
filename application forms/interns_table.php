<?php
include "../dashboard/dashboard_navs.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Applicants Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      body {
        background-color: #f8f9fa;
      }
      .container {
        margin-top: 50px;
      }
      .accordion {
        background-color: #28a745;
        cursor: pointer;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
      }
      .accordion i {
        margin-right: 5px;
      }
      .panel {
        background-color: #fff;
        padding: 10px;
        display: none;
      }
      .active {
        background-color: #333;
      }
      .panel-content {
        margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="card-header">
        <h2 class="text-2xl font-bold mb-6 ">Student Applications</h2>
      </div>
      <div class="application-card ">
        <div class="row mb-3">
          <div class="col-md-6">
            <input type="text" class="form-control" id="searchName" placeholder="Search by Name" oninput="filterTable()">
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" id="searchEmail" placeholder="Search by Email" oninput="filterTable()">
          </div>
          <div class="col-md-12 mt-3">
            <button class="btn btn-secondary" onclick="resetTable()">Reset</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Applicant ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
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
              const accordion = document.createElement('tr');
              accordion.className = 'accordion';
              accordion.innerHTML = `
                            <td>${row.applicant_id}</td>
                            <td>${row.given_name} ${row.middle_name} ${row.family_name}</td>
                            <td>${row.primary_email}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="viewApplicant('${row.applicant_id}')">View</button>
                            </td>
                        `;
              const panel = document.createElement('tr');
              panel.className = 'panel';
              const displayContent = document.createElement('td');
              displayContent.className = 'panel-content';
              displayContent.id = `displayContent-${row.applicant_id.replace('Applicant ', '')}`;
              panel.appendChild(displayContent);
              accordion.addEventListener('click', function() {
                this.classList.toggle('active');
                const panel = this.nextElementSibling;
                if (panel.style.display === 'table-row') {
                  panel.style.display = 'none';
                } else {
                  panel.style.display = 'table-row';
                  const applicantId = this.querySelector('td:first-child').textContent;
                  fetch(`display.php?id=${applicantId.replace('Applicant ', '')}`)
                    .then(response => response.text())
                    .then(data => {
                      displayContent.innerHTML = data;
                    })
                    .catch(error => {
                      console.error('Error fetching display.php:', error);
                    });
                }
              });
              dataContainer.appendChild(accordion);
              dataContainer.appendChild(panel);
            });
          });
      });
      function viewApplicant(applicantId) {
        // Perform the action to view the applicant with the given ID
        console.log('View applicant:', applicantId);
      }
      function resetTable() {
        document.getElementById('searchName').value = '';
        document.getElementById('searchEmail').value = '';
        // Reload the page to reset all fields and data
        location.reload();
      }
      function filterTable() {
        const searchName = document.getElementById('searchName').value.toLowerCase();
        const searchEmail = document.getElementById('searchEmail').value.toLowerCase();
        const rows = document.querySelectorAll('#data-container .accordion');
        rows.forEach(row => {
          const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
          const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
          if (name.includes(searchName) && email.includes(searchEmail)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      }
    </script>
  </body>
</html>