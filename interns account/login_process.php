<?php
session_start();
$servername = "localhost";
$dbUsername = "root"; 
$dbPassword = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"]; 
    $stmt = $conn->prepare("SELECT username, password FROM interns_account WHERE username = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $input_username); 
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($_POST["password"], $hashedPassword)) { 
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $input_username; 
            header("Location:../tailwind/index.php"); 
            exit();
        } else {
            echo '<script>alert("Incorrect password for username: ' . $input_username . '"); window.location.href = "internslogin.php";</script>';
            exit();
        }
    } else {
        $stmt = $conn->prepare("SELECT username, password FROM admin_account WHERE username = ?");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $admin_username = "sipadmin"; 
        $stmt->bind_param("s", $admin_username); 
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($username, $password); 
            $stmt->fetch();
        
            if ($_POST["password"] == $password) { 
                $_SESSION["username"] = $admin_username; 
                header("Location:../admin_dashboard.php"); 
                exit();
            } else {
                echo '<script>alert("Incorrect password for username: ' . $admin_username . '"); window.location.href = "internslogin.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Invalid username: ' . $admin_username . '"); window.location.href = "internslogin.php";</script>';
            exit();
        }
        
        $stmt->close();
    }      
}  
$conn->close();
?>
