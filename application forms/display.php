<?php
include "database.php"; // Include your database connection code
$dbname = "interns_application"; // Replace with your actual database name
?>
<!DOCTYPE html>
<html>
<head>
    <title>Applicant Details</title>
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
            $query = "SELECT a.given_name, a.middle_name, a.family_name, f.school_id, f.regi, f.schedule, f.form1, f.form2, f.form3, f.form4, fn.school_name, fn.regi_name, fn.schedule_name, fn.form1_name, fn.form2_name, fn.form3_name, fn.form4_name
                      FROM files AS f
                      INNER JOIN application AS a ON f.id = a.id
                      INNER JOIN file_names AS fn ON f.file_id = fn.file_id
                      WHERE a.id = $applicant_id";

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

