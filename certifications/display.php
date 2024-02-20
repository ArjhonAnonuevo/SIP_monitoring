<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    die("Username not found in session");
}
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT file_name, description, file_content FROM certifications WHERE user = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $username);


if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->bind_result($fileName, $description, $fileContent);

echo "<div class='grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3'>";
while ($stmt->fetch()) {
    echo "<div class='bg-white p-4 shadow-md rounded-lg'>";
    echo "<h3 class='text-lg font-bold mb-2 text-gray-800'>File Name: " . $fileName . "</h3>";
    echo "<p class='mb-4 text-gray-600'>Description: " . $description . "</p>";
    echo "<div class='flex justify-between items-center'>";
    echo "<a href='download.php?user=" . urlencode($username) . "&type=file' class='bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded'>Download</a>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";

$stmt->close();
$conn->close();
?>
