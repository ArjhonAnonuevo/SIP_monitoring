<?php
// Start the session if not already started
session_start();
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_application";

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the session variable for email exists
if (isset($_SESSION["primary_email"])) {
    $user_email = $_SESSION["primary_email"];

    // Prepare a SELECT statement to fetch the control number
    $sql_fetch_control_number = "SELECT given_name, family_name, control_number FROM application WHERE primary_email = ?";
    $stmt_fetch_control_number = $conn->prepare($sql_fetch_control_number);

    // Check if the statement was prepared successfully
    if ($stmt_fetch_control_number) {
        // Bind parameters and execute the statement
        $stmt_fetch_control_number->bind_param("s", $user_email);
        $stmt_fetch_control_number->execute();

        // Get the result and fetch the data
        $result_fetch_control_number = $stmt_fetch_control_number->get_result();

        if ($result_fetch_control_number->num_rows > 0) {
            $row = $result_fetch_control_number->fetch_assoc();
            $given_name = $row["given_name"] ?? '';
            $family_name = $row["family_name"] ?? '';
            $control_number = $row["control_number"] ?? '';
        } else {
            // Handle no rows found if needed
            $given_name = '';
            $family_name = '';
            $control_number = '';
        }

        // Close the statement
        $stmt_fetch_control_number->close();
    } else {
        // Handle statement preparation error if needed
        die("Error preparing statement: " . $conn->error);
    }
} else {
    // Handle the case where the session variable is not set
    header("Location: error_page.php");
    exit;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <title>Application Confirmation</title>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full md:w-1/2 lg:w-1/3">
        <form action="destroy_session.php" method="post" id="destroySessionForm" class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 inline-block">
                <i class="fa fa-home"></i> Home
            </button>
        </form>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-700">Application Confirmation</h1>
            <img src="sec.png" alt="Logo" class="h-12 w-auto">
        </div>
        <div class="mt-4">
            <p class="text-gray-600">Thank you for your application, <?= $given_name ?>. We have received your information and will process it shortly.</p>
            <?php if (!empty($control_number)): ?>
                <p class="text-blue-500">Your control number is: <?= $control_number ?></p>
                <p>First Name: <?= $given_name ?></p>
                <p>Family Name: <?= $family_name ?></p>
                <p>Email: <?= $_SESSION["primary_email"] ?></p><br>
                <p>Use this Control number to check your Application Status </p>
                <p>http://localhost/SIP/application%20forms/homepage.php</p>
            <?php else: ?>
                <p class="text-red-500">Please check your email for the control number.</p>
            <?php endif; ?>
        </div>
        <div class="mt-6">
            <?php if (!empty($control_number)): ?>
                <!-- Form to trigger PDF download -->
                <form action="download number.php" method="get">
                    <input type="hidden" name="control_number" value="<?= urlencode($control_number) ?>">
                    <input type="hidden" name="given_name" value="<?= urlencode($given_name) ?>">
                    <input type="hidden" name="family_name" value="<?= urlencode($family_name) ?>">
                    <input type="hidden" name="primary_email" value="<?= urlencode($_SESSION["primary_email"]) ?>">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Download Control Number
                    </button>
                </form>
            <?php else: ?>
                <p>No control number available.</p>
            <?php endif; ?>
        </div>
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-700">Next Steps</h2>
            <ul class="list-disc pl-5">
                <li>We will review your application and notify you of the decision.</li>
                <li>If you have any questions, please contact us at support@example.com.</li>
                <li>Follow us on social media for updates.</li>
            </ul>
        </div>
    </div>
</body>

</html>
