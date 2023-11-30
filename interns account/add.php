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
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <title>Document</title>
</head>
<body clas = "bg-gray-200">
<div class="card by-gray-500">
  <div class="container mx-auto">
    <div class="flex flex-wrap">
      <div class="w-full md:w-1/2 lg:w-1/3 p-4">
        <h3 class="text-xl font-bold mb-4 font-serif">ADD USERNAME</h3>
        <div class="mb-4">
        </div>
        <button id="addButton" class="w-lg px-4 py-2 text-white bg-green-800 rounded-md hover:bg-gree-700 focus:outline-none focus:bg-green-500">ADD</button>
      </div>
      <div class="w-full md:w-1/2 lg:w-2/3 p-4">
        <h3 class="text-xl font-bold mb-4 font-serif">USERS</h3>
        <table id="userTable" class="w-full mt-4 border border-gray-300">
          <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">USERNAME</th>     
          </tr>
          <?php include "fetch.php"?>
        </table>
      </div>
    </div>
  </div>
</div>


<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p class="text-gray-700 text-lg leading-relaxed">Add a username based on the format SIP-0000-0000</p>
    <form action="submit.php" method="POST">
      <div class="flex items-center mt-4">
        <input type="text" id="username" name="username" class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded-md focus:outline-none focus:bg-white" placeholder="Enter username">
      </div>
      <div class="mt-4">
        <div class="mb-4">
          <input type="text" id="fname" name="fname" class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded-md focus:outline-none focus:bg-white" placeholder="Enter First Name">
        </div>
        <div class="mb-4">
          <input type="text" id="mname" name="mname" class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded-md focus:outline-none focus:bg-white" placeholder="Enter Middle Name">
        </div>
        <div class="mb-4">
          <input type="text" id="lname" name="lname" class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded-md focus:outline-none focus:bg-white" placeholder="Enter Last Name">
        </div>
      </div>
      <button type="submit" class="mt-4 px-4 py-2 text-white bg-green-800 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-500">Submit</button>
    </form>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
  // Get the button element
  const addButton = document.getElementById('addButton');

  // Get the modal element
  const modal = document.getElementById('myModal');

  // Get the close button element inside the modal
  const closeButton = modal.querySelector('.close');

  // Add a click event listener to the button
  addButton.addEventListener('click', function() {
    // Display the modal by changing its display style to "block"
    modal.style.display = 'block';
  });
  // Add a click event listener to the close button
  closeButton.addEventListener('click', function() {
    // Hide the modal by changing its display style to "none"
    modal.style.display = 'none';
  });
</script>
</body>
</html>
