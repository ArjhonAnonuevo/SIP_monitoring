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



include "../dashboard/admin_navs.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <title>Document</title>
</head>
<body class="bg-gray-100">
<div class = "md:ml-48 xl:ml-48 lg:ml-48">
<div class="mx-auto md:max-w-7xl bg-white shadow-md p-6 mt-8 rounded-md">
        <div class="flex flex-col md:flex-row md:justify-between items-center mb-5">
            <h3 class="text-2xl font-bold mb-6 font-sans md:mb-0 md:text-3xl">Add Username</h3>
        </div>

        <form action="submit.php" method="POST" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">User ID</label>
                    <input type="username" name="username" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input type="text" name="fname" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Middle Name</label>
                    <input type="text" name="mname" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                    <input type="text" name="lname" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Submit
                </button>
            </div>
        </form>
        <!-- <div class="bg-white shadow-md overflow-x-auto"> -->
            <!-- <h3 class="text-2xl font-bold mb-5 font-serif">Users</h3> -->
            <table id="userTable" class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-green-700 text-white">
                        <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Username</th>
                        <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">First Name</th>
                        <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Middle Name</th>
                        <th class="px-4 py-2 md:w-1/6 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Last Name</th>
                    </tr>
                </thead>
                <tbody class = "text-gray-700">
                    <?php include "fetch.php"?>
                </tbody>
          </div>
            </table>
        </div>
    </div>
</div>
</body>
</html>
