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
    <link href=" ../css/dist/tailwind.min.css" rel="stylesheet"> 
    <title>Uploaded Files</title>
</head>

<body>
    <?php
    include "../dashboard/dashboard_navs.php";
    ?>
    <div class="overflow-auto">
        <div class="bg-gray-200 shadow-md rounded-lg p-4 overflow-auto">
            <span class="text-2xl font-bold" style="font-family: 'Karma';">Your Certificates</span>
            <ul class="flex flex-col py-4 space-y-1">
                <li class="px-5">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-serif">List: </div>
                    </div>
                    <?php include "display.php"; ?>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
