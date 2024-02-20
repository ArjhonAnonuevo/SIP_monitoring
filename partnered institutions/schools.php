<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="antialiased text-gray-900 bg-gray-100">
    <!-- Partnerships Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-8">
                Our Partnered School Institutions
            </h2>
            <div id="schoolCards" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <?php
                    // Replace the following database connection code with your actual connection details
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "interns_management";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch school data from the database
                    $sql = "SELECT school, GROUP_CONCAT(id) AS internIds, COUNT(*) AS internsCount FROM interns_profile GROUP BY school";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="rounded-lg overflow-hidden shadow-lg p-4 bg-white border-2 border-gray-200 hover:shadow-2xl hover:border-blue-500 transition-all duration-300">';
                            echo '<img class="h-48 w-full object-cover" src="../header/sec.png" alt="' . $row['school'] . '">';
                            echo '<div class="px-6 py-4">';
                            echo '<div class="font-bold text-xl mb-2">' . $row['school'] . '</div>';
                            echo '<p class="text-gray-700 text-base">Description of the partnership or key collaborative aspects for ' . $row['school'] . '.</p>';
                            echo '<div class="mt-4 text-sm text-gray-500">';
                            echo '<span class="font-bold">Total Interns: </span>';
                            echo '<span class="numApplicants">' . $row['internsCount'] . '</span>';
                            echo '</div>';
                            echo '<div class="mt-2 text-sm text-gray-500">';
                            echo '<span class="font-bold">Intern IDs: </span>';
                            echo '<span class="internIds">' . $row['internIds'] . '</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                ?>
            </div>
        </div>
    </section>
</body>
</html>
