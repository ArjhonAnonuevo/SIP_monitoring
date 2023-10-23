    <?php
    include "create table.php";
    session_start();
    $username = $_SESSION['username'];
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "interns_management";
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $currentMonthIndex = date('n'); 
        $previousMonthIndex = ($currentMonthIndex - 2 + 12) % 12;
        $previousMonthName = $monthNames[$previousMonthIndex]; 
        $stmt_check = $conn->prepare("SELECT * FROM month WHERE username = ? AND month = ?");
        $stmt_check->bind_param("ss", $username, $previousMonthName);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            echo '<script>alert("You have already submitted a form this month.");</script>';
            echo '<script>window.location.href = "reports.php";</script>';
            exit();
        }
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        $fileName = $_FILES['file']['name'];
        $file = file_get_contents($_FILES["file"]["tmp_name"]);
        $currentDate = date("Y-m-d");
        $stmt1 = $conn->prepare("INSERT INTO month (file_name, file_type, file_size, file, month, current_month, username) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("ssissss", $fileName, $fileType, $fileSize, $file, $previousMonthName, $currentDate, $username);
        if ($stmt1->execute()) {
            echo '<script>alert("Reports submitted successfully!");</script>';
            echo '<script>window.location.href = "reports.php";</script>';
            $stmt1->close(); 
        } else {
            echo "Error: " . $stmt1->error;
        }
        $query = "SELECT file_name FROM month WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $fileNames = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $fileNames[] = $row['file_name'];
        }
    }
    $stmt_check->close();
    $conn->close();
    ?>