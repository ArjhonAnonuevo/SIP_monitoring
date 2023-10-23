<?php
include "database.php"; // Include your database connection code
$dbname = "interns_application"; // Replace with your actual database name
?>
<!DOCTYPE html>
<html>
<head>
    <title>Interns Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mx-auto p-4 ">
        <?php
        if (isset($_GET['id'])) {
            $applicant_id = $_GET['id'];

            // Connect to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve data from multiple tables
                $query = "SELECT m.file_name, m.file_type, m.file_size, m.file, m.month, p.name, a.username
                FROM month AS m
                INNER JOIN interns_account AS a ON m.username = a.username
                INNER JOIN interns_profile AS p ON a.profile_id = p.id
                WHERE a.username = $user
                ";

            $result = $conn->query($query);

            if ($result) {
                if ($result->num_rows > 0) {
                    $data = $result->fetch_assoc();
                    // Display file names and provide download links
                    echo "<h2 class='text-2xl font-bold mt-8' style='color: #333; font-family: Arial, sans-serif;'>File Downloads</h2>";
                    echo "<div class='accordion-content'>";
                    echo "<p>School File Name: " . $data['school_name'] . "</p>";
                    echo "<a href='download.php?id=$applicant_id&type=school_id' class='text-blue-500'>Download School File</a><br>";

                    echo "<p>Registration File Name: " . $data['regi_name'] . "</p>";
                    echo "<a href='download.php?id=$applicant_id&type=regi' class='text-blue-500'>Download Registration File</a><br>";

                    echo "<p>Schedule File Name: " . $data['schedule_name'] . "</p>";
                    echo "<a href='download.php?id=$applicant_id&type=schedule' class='text-blue-500'>Download Schedule File</a><br>";

                    echo "<p>Form 1 File Name: " . $data['form1_name'] . "</p>";
                    echo "<a href='download.php?id=$applicant_id&type=form1' class='text-blue-500'>Download Form 1 File</a><br>";

                    echo "<p>Form 2 File Name: " . $data['form2_name'] . "</p>";
                    echo "<a href='download.php?id=$applicant_id&type=form2' class='text-blue-500'>Download Form 2 File</a><br>";

                    echo "<p>Form 3 File Name: " . $data['form3_name'] . "</p>";
                    echo "<a href='download.php?id=$applicant_id&type=form3' class='text-blue-500'>Download Form 3 File</a><br>";

                    echo "<p>Form 4 File Name: " . $data['form4_name'] . "</p>";
                    echo "<a href='download.php?id=$applicant_id&type=form4' class='text-blue-500'>Download Form 4 File</a><br>";
                    echo "</div>";

                } else {
                    echo "<p class='text-red-500'>Applicant not found.</p>";
                }
            } else {
                echo "<p class='text-red-500'>Error executing query: " . $conn->error . "</p>";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "<p class='text-red-500'>Invalid request.</p>";
        }
        ?>
    </div>
</body>
</html>

