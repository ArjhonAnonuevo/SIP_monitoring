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

$query = "SELECT * FROM interns_profile
          JOIN interns_account ON interns_profile.id = interns_account.profile_id
          WHERE interns_account.id = $user_id";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

  echo '
<div class="card bg-light rounded h-100 p-4 mb-4">
    <div class="information-section">
        <h2 class="card-title">Personal Information</h2>
        <div class="card-text">
            <div><span class="label">Name:</span> '.$row['name'].'</div>
            <div><span class="label">Gender:</span> '.$row['gender'].'</div>
            <div><span class="label">Age:</span> '.$row['age'].'</div>
            <div><span class="label">Birthday:</span> '.$row['birthday'].'</div>
            <div><span class="label">Course:</span> '.$row['course'].'</div>
            <div><span class="label">School:</span> '.$row['school'].'</div>
        </div>
    </div>
</div>
</div>
<!-- Other cards here -->
</div>
</div>
</div>';

echo '
<div class="col-sm-12 col-xl-6">
    <div class="card bg-light rounded h-100 p-4 mb-4">
        <div class="information-section">
            <h2 class="card-title">Contacts</h2>
            <div class="card-text">
                <div><span class="label">Personal Contact:</span> '.$row['contact_number'].'</div>
                <div><span class="label">Emergency Contact:</span> '.$row['emergency_contact'].'</div>
            </div>
        </div>
    </div>
</div>';

echo '
<div class="col-sm-12 col-xl-6">
    <div class="card bg-light rounded h-100 p-4 mb-4">
        <div class="information-section">
            <h2 class="card-title">Other Information</h2>
            <div class="card-text">
                <div><span class="label">Designation:</span> '.$row['department'].'</div>
                <div><span class="label">Hours Required:</span> '.$row['hours_required'].'</div>
            </div>
        </div>
    </div>';

    mysqli_free_result($result);
} else {
    echo "No profile information found for this user.";
}
$conn->close();
?>

<style>
.profile-form {
    margin: 20px auto;
    max-width: 400px;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    border-radius: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    
}

.info-list {
    list-style: none;
    padding: 0;
}

.info-list li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.info-label {
    width: 120px;
    font-weight: bold;
    color: #555;
}

.info-list li span {
    flex-grow: 1;
}
    .label {
        display: inline-block;
        width: 150px;
        font-weight: bold;
        color: #333;
    }

    /* Additional styling for individual labels */
    .label.name {
        color: #007bff; /* Blue color for "Name" label */
    }

    .label.contact {
        color: #dc3545; /* Red color for "Contact" labels */
    }

    .label.other {
        color: #28a745; /* Green color for "Other Information" labels */
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .label {
            width: auto;
            display: inline;
            margin-bottom: 5px;
        }
       
    }
</style>
