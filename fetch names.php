<!DOCTYPE html>
<html>
<head>
    <title>Edit Request</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div class="container mx-auto md:w-auto flex flex-col justify-center mb-45">
        <div class="py-8">
            <div class="overflow-x-auto">
                <table class="table-auto border border-gray-300 w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-100 border-b font-serif border-r">Interns Name</th>
                            <th class="px-4 py-2 bg-gray-100 border-b font-serif border-r">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="internsList" class="p-4 bg-gray-200">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Make an AJAX request to the PHP script
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'request names.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                populateList(data);
            }
        };
        xhr.send();

        // Function to populate the table with data
        function populateList(data) {
            var tableBody = document.getElementById('internsList');
            for (var i = 0; i < data.length; i++) {
                var row = document.createElement('tr');
                var nameCell = document.createElement('td');
                var link = document.createElement('a');
                link.href = 'request/message.php?username=' + encodeURIComponent(data[i].username);
                link.textContent = data[i].name;
                nameCell.appendChild(link);
                row.appendChild(nameCell);

                var checkboxCell = document.createElement('td');
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.className = 'h-6 w-6';
                checkbox.dataset.username = data[i].username; // Set the username as a data attribute
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Perform delete operation here
                        var row = this.parentNode.parentNode;
                        var username = this.dataset.username; // Get the username from the data attribute
                        deleteFromDatabase(username, row);
                    }
                });
                checkboxCell.appendChild(checkbox);
                row.appendChild(checkboxCell);

                tableBody.appendChild(row);
            }
        }

        // Function to delete data from the database
        function deleteFromDatabase(username, row) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Check the response from the server and handle accordingly
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Delete operation successful, remove the row from the table
                        row.parentNode.removeChild(row);
                    } else {
                        // Delete operation failed, handle the error
                        console.error(response.error);
                    }
                }
            };
            xhr.send('username=' + encodeURIComponent(username)); // Pass the username as a parameter
        }
    </script>
</body>
</html>
