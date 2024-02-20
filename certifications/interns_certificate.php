<?php
session_start();

// Check if the username is passed as a parameter
if (isset($_GET["username"])) {
    $username = $_GET["username"];
} else {
    // Check if the username is stored in the session
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    } else {
        // Handle the case when the username is not available
        $username = "Unknown"; // Set a default value
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <title>Uploaded Files</title>
</head>

<body class="bg-gray-100">

    <?php include "../dashboard/dashboard_navs.php"; ?>

    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-center text-transparent text-gray-700 bg-clip-text">
                Certificates
            </h1>

            <div class="mt-8">
                <?php include "display.php"; ?>
            </div>
        </div>
    </div>

</body>

</html>
