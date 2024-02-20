<?php
// // session_start();
// // // Check if the username is passed as a parameter
// // if (isset($_GET["username"])) {
// //     $username = $_GET["username"];
// // } else {
// //     // Check if the username is stored in the session
// //     if (isset($_SESSION["username"])) {
// //         $username = $_SESSION["username"];
// //     } else {
// //         // Handle the case when the username is not available
// //         $username = "Unknown"; // Set a default value
// //     }
// }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href=" ../css/dist/tailwind.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
      html,
      body {
        font-family: "Rubik", sans-serif;
      }
      /* navigation - show navigation always on the large screen devices with (min-width:1024) */
      @media (min-width: 1024px) {
        .top-navbar {
          display: inline-flex !important;
        }
      }
      /* Adjust dropdown menu position */
      .relative {
        position: relative;
      }
      .absolute.right-0 {
        right: 0;
      }
      .sidebar {
        width: 200px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: -200px;
        transition: left 0.3s ease;
        z-index: 9999;
      }
      .sidebar.open {
        left: 0;
      }
    </style>
  </head>
  <body>
    <nav class="flex items-center bg-green-600 p-2 flex-wrap shadow-md">
      <button id="sidebar-toggle" class="block relative flex-shrink-0 p-2 mr-2 text-white hover:bg-gray-100 hover:text-gray-800 focus:bg-gray-100 focus:text-gray-800 rounded-full">
        <span class="sr-only">Menu</span>
        <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
      </button>
      <div id="sidebar" class="sidebar bg-green-800">
      <ul class="flex flex-col py-4 space-y-1">
        <li class="px-5">
          <div class="flex flex-row items-center h-8">
            <div class="text-sm font-light tracking-wide text-white">Menu</div>
          </div>
        </li>
        <li>
          <a href="../tailwind/index.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
          </a>
          <div>
        </li>
        <li>
          <a href="../attendance/attendance form.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
            <img width="20" height="25" src="https://img.icons8.com/fluency-systems-regular/48/FFFFFF/attendance-mark--v19.png" alt="attendance-mark--v19"/>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Attendance</span>
          </a>
        </li>
        <li>
          <a href="../monthly reports/reports.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white     hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
            <img width="20" height="25" src="https://img.icons8.com/material-rounded/24/FFFFFF/pdf.png" alt="pdf"/>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Monthly Reports</span>
          </a>
        </li>
        <li>
          <a href="../certifications/interns_certificate.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white     hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
            <img width="20" height="12  " src="https://img.icons8.com/ios-filled/100/FFFFFF/contract.png" alt="contract"/>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Certifications</span>
          </a>
        </li>

        <li class="px-5">
          <div class="flex flex-row items-center h-8">
            <div class="text-sm font-light tracking-wide text-white">Settings</div>
          </div>
        </li>
        <li>
          <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Profile</span>
          </a>
        </li>
        <li>
          <a href="../dashboard/logout.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
          </a>
        </li>
      </ul>
      </div>
      <a href="../tailwind/index.php" class="p-2 mr-auto inline-flex items-center">
        <img src="../dashboard/sec.png" alt="New Logo" class="h-3vh w-20 mr-2">
      </a>
      <div class="relative ml-auto">
        <button class="flex items-center text-white px-4 py-2 rounded focus:outline-none">
          <i class="material-icons mr-2">person</i>
          <span class="mr-2"><?php echo $username; ?></span>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        $(".nav-toggler").each(function(_, navToggler) {
          var target = $(navToggler).data("target");
          $(navToggler).on("click", function() {
            $(target).animate({
              height: "toggle"
            });
          });
        });
        $(".relative").click(function() {
          $(this).find("ul").toggleClass("hidden");
        });
      });
      const sidebarToggle = document.getElementById('sidebar-toggle');
      const sidebar = document.getElementById('sidebar');
      sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        updateToggleButtonPosition();
      });
      function updateToggleButtonPosition() {
        const sidebarOpen = sidebar.classList.contains('open');
        if (sidebarOpen) {
          sidebarToggle.style.left = `${sidebar.offsetWidth}px`;
        } else {
          sidebarToggle.style.left = '10px';
        }
      }
    </script>
  </body>
</html>