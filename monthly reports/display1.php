<?php
$username = $_GET['username'];
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "interns_management";
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT file_name, file, month FROM month WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
include "../dashboard/admin_navs.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Monthly Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
      @media (max-width: 640px) {
        .table-responsive {
          overflow-x: auto;
        }
      }
    </style>
  </head>
  <body class="bg-gray-100">
  <div class="container mx-auto px-50 sm:px-8">
    <div class="py-8">
      <h1 class="text-2xl font-bold text-center mb-4">Monthly Reports Table</h1>
      <div class="shadow overflow-hidden rounded border-b border-gray-200">
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">File Name</th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Month</th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo $row['file_name']; ?></td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo $row['month']; ?></td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href='download.php?username=<?php echo urlencode($username); ?>&type=file' class='bg-green-700 hover:bg-green-600 text-white py-1 px-3 rounded'>Download</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>