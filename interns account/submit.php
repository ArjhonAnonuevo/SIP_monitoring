<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];

    // Connect to the database
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "interns_management";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!empty($username) && !empty($fname) && !empty($mname) && !empty($lname)) {
        $sql = "INSERT INTO interns (interns_username, fname, mname, lname) VALUES ('$username', '$fname', '$mname', '$lname')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Username and name inserted successfully'); window.location.href = 'add.php';</script>";
        } else {
            echo "<script>alert('Error inserting data: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all the fields.'); window.location.href = 'add.php';</script>";
    }

    $conn->close();
}
?>
