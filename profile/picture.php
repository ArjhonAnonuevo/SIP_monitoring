<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: internslogin.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

$query = "SELECT * FROM interns_profile
          JOIN interns_account ON interns_profile.id = interns_account.profile_id
          WHERE interns_account.username = '$user_id'";



$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>User Information</h2>
    </div>

    <div class="card-container">
        <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
        <h3><?php echo $userData['name']; ?></h3>
        <h6><?php echo $_SESSION["username"];?></h6>
        <p>User interface designer and <br/> front-end developer</p>
        <div class="skills">
            <h6>Personal Information</h6>
            <ul>
        <li>Gender: <?php echo $userData['gender']; ?></li>
        <li>Age: <?php echo $userData['age']; ?></li>
        <li>Birthday: <?php echo $userData['birthday']; ?></li>
        <li>Contact Number: <?php echo $userData['contact_number']; ?></li>
        <li>School: <?php echo $userData['school']; ?></li>
        <li>Course: <?php echo $userData['course']; ?></li>
        <li>Department: <?php echo $userData['department']; ?></li>
        <li>Hours Required: <?php echo $userData['hours_required']; ?></li>
        <li>Emergency Contact: <?php echo $userData['emergency_contact']; ?></li>
            </ul>
        </div>
    </div>
</body>
</html>



<?php
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
