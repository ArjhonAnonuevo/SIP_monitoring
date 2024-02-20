<!DOCTYPE html>
<html>
 <head>
    <title>Applicants Information</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    </style>
 </head>
 <body class="bg-gray-100">
    <?php
    session_start();
    if (isset($_GET["username"])) {
        $username = $_GET["username"];
    } else {
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
        } else {
            $username = "Unknown";
        }
    }
      include "../dashboard/admin_navs.php";
      
      // Connect to your database here
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "interns_management";

      // Create a new database connection
      $conn = new mysqli($servername, $username, $password, $dbname);      
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      // Your SQL query goes here
      $sql = "SELECT ip.name, ip.mname, ip.lname, ip.department, ia.username
      FROM interns_profile ip
      JOIN interns_account ia ON ia.profile_id = ip.id";
      $result = $conn->query($sql);
    ?>
    <div class = "md:ml-48 xl:ml-48 lg:48"> 
    <div class="container mx-auto flex flex-col justify-center mt-7">
      <div class="py-8">
        <h2 class="text-2xl font-bold font-serif">Upload Certificate</h2>
          <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search...">
          </div>
          <div class="overflow-x-auto mt-4">
            <table class="table-auto w-full">
              <thead>
                <tr class="bg-green-700 text-white">
                 <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                 <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Department</th>
                 <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Sip number</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='border px-8 py-4 font-poppins'><a href='upload.php?username=" . urlencode($row['username']) . "' class='text-blue-500'>" . $row['name'] . " " . $row['mname'] . " " . $row['lname'] . "</a></td>";
                        echo "<td class='uppercase border px-8 py-4 font-poppins'>" . $row['department'] . "</td>";
                        echo "<td class='border px-8 py-4 font-poppins'>" . $row['username'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class = 'uppercase border px-8 py-4 font-poppins'>No results found.</td></tr>";
                }
                $conn->close();
                ?>
              </tbody>
            </table>
          </div>
    </div>
              </div>
 </body>
</html>
