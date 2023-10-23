<?php
$username_db = "root";
$password_db = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT month FROM month WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$username = $_SESSION['username'];

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $previousMonthFromDB = $row['month'];
    }
}
$stmt->close();
$conn->close();
echo json_encode(array("previousMonth" => $previousMonthFromDB));
?>
