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
// require "create_table.php";
include "../dashboard/dashboard_navs.php";
// Establish a database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "interns_management";
$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
    echo "Failed to connect to the database.";
    exit;
}
// Retrieve the submission date from the database based on the username
// SQL query to fetch the submission date based on the username
$sql = "SELECT submission_date FROM previous_month_submission WHERE user_details = '$username'";
$result = mysqli_query($connection, $sql);
if ($result) {
  // Fetch the submission date from the result
  $row = mysqli_fetch_assoc($result);
  if ($row && isset($row['submission_date'])) {
      $submissionDate = $row['submission_date'];
  } else {
      // Handle the case when the submission date is not available
      $submissionDate = "Unknown"; // Set a default value
  }
} else {
  // Handle the case when the query fails
  echo "Failed to retrieve the submission date.";
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <link href=" ../css/dist/bootstrap.min.css" rel="stylesheet">
    <link href=" ../css/dist/tailwind.min.css" rel="stylesheet">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <script src = "../css/dist/bootstrap.bundle.min.js"></script>
    <script src = "../css/dist/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <!-- <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet"> -->
    <title>Montly Reports </title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
      .font-roboto {
        font-family: 'Roboto', sans-serif;
      }
    </style>
  </head>
  <body>
    <div class="flex flex-col bg-white py-20 px-12">
      <div class="flex flex-col px-20 md:px-10 md:flex-row items-center justify-center gap-6">
        <div>
          <div class="bg-green-700 p-4 h-20 md:h-24">
            <h3 class="text-lg md:text-2xl font-bold text-white font-serif md:h-60">Your uploaded Reports</h3>
            <div class="container mx-auto">
              <header class="md:flex justify-between items-center">
              </header>
            </div>
          </div>
          <div class="px-9 pt-10 pb-14 bg-green-800 rounded-b-lg">
            <div class="text-white space-y-4">
              <h3 class="text-xl font-bold lead-xl bold">Reports Uploaded</h3>
              <div class="text-lg font-light">This is your uploaded files</div>
            </div>
            <div class="flex justify-between pt-8">
              <ul class="flex flex-col gap-y-2.5">
                <li class="flex space-x-3 text-white">
                  <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/pdf.png" alt="pdf" class="w-6 h-6" />
                  <?php include 'report_file.php';?>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="flex flex-col px-20 md:px-10 md:flex-row items-center justify-center gap-6">
          <div>
            <div class="bg-green-700 p-4 h-20 md:h-20">
              <h3 class="text-lg md:text-2xl font-bold text-white font-lato">Accomplishment reports</h3>
              <div class="container mx-auto">
                <header class="md:flex justify-between items-center">
                </header>
              </div>
            </div>
            <div class="px-4 md:px-9 pt-10 pb-14 bg-green-800 rounded-b-lg">
              <div class="text-white space-y-4">
                <h3 class="text-lg md:text-xl font-bold lead-xl bold">Monthly reports</h3>
                <div id="nextMonth" class="text-base md:text-lg font-light"></div>
              </div>
              <div class="flex justify-between pt-8">
                <div class="flex flex-col justify-end">
                  <div class="flex">
                    <button id="upload1" class="py-3 px-6 bg-white text-primary-200 paragraph-m rounded-full mr-4" data-bs-toggle="modal" data-bs-target="#modals">Upload</button>
                    <button id="upload2" class="py-3 px-6 bg-white text-primary-200 paragraph-m rounded-full" data-bs-toggle="modal" data-bs-target="#modals2">Request Edit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modals" tabindex="-1" aria-labelledby="modals" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-green-800 text-white" style="font-family: 'Lato', sans-serif; font-weight: bold;">
                  <h5 class="modal-title" id="modals" style="font-size: 20px;">Upload Your monthly reports</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="submit1.php" method="POST" enctype="multipart/form-data" id="uploadForm">
                    <div class="mb-3">
                      <label for="fileInput1" class="form-label" style="font-family: 'Lato', sans-serif; font-size: 16px;">Choose file</label>
                      <input type="file" class="form-control" id="fileInput" name="file" style="font-size: 14px;" required>
                      <p id="fileName" style="margin-top: 10px;" style="font-size: 15px"></p>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modals2" tabindex="-1" aria-labelledby="modals" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-green-800 text-white" style="font-family: 'Lato', sans-serif; font-weight: bold;">
                  <h5 class="modal-title text-2xl font-bold" id="modals">Request edit for uploaded Files</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="send.php" method="POST" id="request">
                    <div class="mb-3">
                      <span class="form-label" style="font-family: 'Lato', sans-serif; font-size: 16px;">Subject</span>
                      <div class="w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                          <input name="description" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-pink-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" placeholder=" " />
                        </div>
                        <span class="form-label" style="font-family: 'Lato', sans-serif; font-size: 16px;">Message:</span>
                        <textarea name="message" class="mb-100 md:h-96 md:w-96 sm:h-96 sm:w-96 rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-pink-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" placeholder=" "></textarea>
                      </div>
                    </div>
                    <div class="flex justify-center">
                      <button type="submit" class="bg-green-800 text-white rounded px-4 py-2 text-lg hover:bg-green-600 bold-font hover:text-white">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-col px-20 md:px-10 md:flex-row items-center justify-center gap-6">
            <div>
              <div class="bg-green-700 p-4 h-20 md:h-32">
                <h3 class="text-lg md:text-2xl font-bold text-white font-lato">Previous Month of Submission of accomplishment reports</h3>
                <div class="container mx-auto">
                  <header class="md:flex justify-between items-center">
                  </header>
                </div>
              </div>
              <div class="px-4 md:px-9 pt-10 pb-14 bg-green-800 rounded-b-lg">
                <div class="text-white space-y-4">
                  <h3 class="text-lg md:text-xl font-bold lead-xl bold">Monthly reports</h3>
                  <p class="text-base md:text-lg font-light">Upload previous monthly reports for month of <?php //echo $submissionDate; ?></p>
                </div>
                <?php
      // Check if the current username exists in previous_month_submission
      $username = $_SESSION['username'];
      $sql = "SELECT * FROM previous_month_submission WHERE user_details = '$username'";
      $result = mysqli_query($connection, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
                <div class="flex justify-between pt-8">
                  <div class="flex flex-col justify-end">
                    <div class="flex">
                      <button id="upload3" class="py-3 px-6 bg-white text-primary-200 paragraph-m rounded-full mr-4" data-bs-toggle="modal" data-bs-target="#modals3">Upload</button>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="modals3" tabindex="-1" aria-labelledby="modals" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-green-800 text-white" style="font-family: 'Lato', sans-serif; font-weight: bold;">
                        <h5 class="modal-title" id="modals" style="font-size: 20px;">Upload Your monthly reports</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="submit2.php" method="POST" enctype="multipart/form-data" id="uploadForm">
                          <div class="mb-3">
                            <label for="fileInput2" class="form-label" style="font-family: 'Lato', sans-serif; font-size: 16px;">Choose file</label>
                            <input type="file" class="form-control" id="fileInput2" name="file2" style="font-size: 14px;" required>
                            <p id="fileName" style="margin-top: 10px;" style="font-size: 15px"></p>
                          </div>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <script>
            $(document).ready(function() {
              // Enable Bootstrap 5 modal functionality
              var myModal = new bootstrap.Modal(document.getElementById('myModal'));
              $('.trigger-btn').click(function() {
                myModal.show();
              });
            });
          </script>
  </body>
</html>
<script src="reports1.js"></script>

<!-- <script src = "reset.js"></script> -->