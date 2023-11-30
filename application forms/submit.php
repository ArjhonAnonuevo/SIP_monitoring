<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_application";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function isGmail($email) {
    $email = trim($email); // in case there's any whitespace
    return mb_substr($email, -10) === '@gmail.com';
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $primary_email = $_POST["primary_email"];
    if (!filter_var($primary_email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format"); window.location.href = "forms.php";</script>';
        exit;
    }
    if (!isGmail($primary_email)) {
        echo '<script>alert("Only Gmail addresses are accepted"); window.location.href = "forms.php";</script>';
        exit;
    }
 
    $sql_check = "SELECT * FROM application WHERE primary_email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $primary_email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    if ($result_check->num_rows > 0) {
        echo '<script>alert("You have already responded.");</script>';
        echo '<script>window.location.href = "responded.php";</script>';
        exit;
    }
}
    $given_name = $_POST["given_name"];
    $middle_name = $_POST["middle_name"];
    $family_name = $_POST["family_name"];
    $address = $_POST["address"];
    $place_birth = $_POST["place_birth"];
    $birthday = $_POST["birthday"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $contact = $_POST["contact"];
    $landline = $_POST["landline"];
    $primary_email = $_POST["primary_email"];
    $secondary_email = $_POST["secondary_email"];
    $school_id = file_get_contents($_FILES["school_id"]["tmp_name"]);
    $regi = file_get_contents($_FILES["regi"]["tmp_name"]);
    $schedule = file_get_contents($_FILES["schedule"]["tmp_name"]);
    $form1 = file_get_contents($_FILES["form1"]["tmp_name"]);
    $form2 = file_get_contents($_FILES["form2"]["tmp_name"]);
    $form3 = file_get_contents($_FILES["form3"]["tmp_name"]);
    $form4 = file_get_contents($_FILES["form4"]["tmp_name"]);

    $sql = "INSERT INTO application (given_name, middle_name, family_name, address, place_birth, birthday, age, gender, contact, landline, primary_email, secondary_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssss",
        $given_name,
        $middle_name,
        $family_name,
        $address,
        $place_birth,
        $birthday,
        $age,
        $gender,
        $contact,
        $landline,
        $primary_email,
        $secondary_email
    );

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        $sql_files = "INSERT INTO files (id, school_id, regi, schedule, form1, form2, form3, form4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_files = $conn->prepare($sql_files);
        $stmt_files->bind_param(
            "isssssss",
            $last_id,
            $school_id,
            $regi,
            $schedule,
            $form1,
            $form2,
            $form3,
            $form4
        );
        if ($stmt_files->execute()) {
            $file_id = $conn->insert_id;
            $school_name = $_FILES["school_id"]["name"];
            $regi_name = $_FILES["regi"]["name"];
            $schedule_name = $_FILES["schedule"]["name"];
            $form1_name = $_FILES["form1"]["name"];
            $form2_name = $_FILES["form2"]["name"];
            $form3_name = $_FILES["form3"]["name"];
            $form4_name = $_FILES["form4"]["name"];

            $sql_file_names = "INSERT INTO file_names (file_id, school_name, regi_name, schedule_name, form1_name, form2_name, form3_name, form4_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_file_names = $conn->prepare($sql_file_names);
            $stmt_file_names->bind_param(
                "isssssss",
                $file_id,
                $school_name,
                $regi_name,
                $schedule_name,
                $form1_name,
                $form2_name,
                $form3_name,
                $form4_name
            );

            if ($stmt_file_names->execute()) {
                echo '<script>alert("Form submitted successfully!");</script>';
                echo '<script>window.location.href = "confirmation.php";</script>';
                exit();
            } else {
            echo "Error inserting into files table: " . $stmt_files->error;
        }
    } else {
        echo "Error inserting into application table: " . $stmt->error;
    }
    $stmt->close();
    $stmt_files->close();
    $conn->close();
}
?>
