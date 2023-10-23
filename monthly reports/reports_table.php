<!DOCTYPE html>
<html>
<head>
    <title>Interns Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .panel {
            display: none;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Interns Data</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="internsTable">
            </tbody>
        </table>
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
                var idCell = row.insertCell(0);
                var nameCell = row.insertCell(1);
                var departmentCell = row.insertCell(2);
                var usernameCell = row.insertCell(3);
                var actionCell = row.insertCell(4);

                idCell.innerHTML = data[i].id;
                nameCell.innerHTML = data[i].name;
                departmentCell.innerHTML = data[i].department;
                usernameCell.innerHTML = data[i].username;

                var viewButton = document.createElement('button');
                viewButton.textContent = 'View';
                viewButton.className = 'btn btn-primary';
                viewButton.addEventListener('click', createTogglePanelFunction(data[i].id));
                actionCell.appendChild(viewButton);

                var panel = document.createElement('div');
                panel.id = 'panel-' + data[i].id;
                panel.className = 'panel';
                row.insertAdjacentElement('afterend', panel);

                fetch('display.php?id=' + data[i].id)
                    .then(response => response.text())
                    .then(content => {
                        panel.innerHTML = content;
                    })
                    .catch(error => {
                        console.error('Error fetching display.php:', error);
                    });
            }
        }

        // Function to create a togglePanel function for each button
        function createTogglePanelFunction(id) {
            return function() {
                var panel = document.getElementById('panel-' + id);
                if (panel.style.display === 'none') {
                    panel.style.display = 'block';
                } else {
                    panel.style.display = 'none';
                }
            };
        }
    </script>
</body>
</html>
