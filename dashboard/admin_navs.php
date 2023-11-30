<?php
//  session_start();
//  if (isset($_GET["username"])) {
//      $admin_username = $_GET["username"];
//  } else {
//      // Check if the username is stored in the session
//      if (isset($_SESSION["username"])) {
//          $admin_username = $_SESSION["username"];
//      } else {
//          // Handle the case when the username is not available
//        $admin_username = "Unknown"; // Set a default value
//     }
// }
?>
<!DOCTYPE html>
<html>
  <head>
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
    <nav class="flex items-center bg-green-600 p-2 flex-wrap">
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
            <a href="../admin_dashboard.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </span>
              <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="../attendance/display attendance.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
</svg>
            </span>
              <span class="ml-2 text-sm tracking-wide truncate">Attendance</span>
            </a>
          </li>
          <li>
            <a href="../monthly reports/reports_table.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white     hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
  <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm2.25 8.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5zm0 3a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5z" clip-rule="evenodd" />
    </svg>
            </span>
              <span class="ml-2 text-sm tracking-wide truncate">Monthly Reports</span>
            </a>
          </li>
          <li>
            <a href="../certifications/certifications.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white     hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
  <path d="M3 3.5A1.5 1.5 0 014.5 2h6.879a1.5 1.5 0 011.06.44l4.122 4.12A1.5 1.5 0 0117 7.622V16.5a1.5 1.5 0 01-1.5 1.5h-11A1.5 1.5 0 013 16.5v-13z" />
</svg>
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
            <a href="#" class="relative flex flex-row items-center focus:outline-none text-white border-l-4 border-transparent pr-6"onclick="toggleDropdown()">
              <span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </span>
              <span class="ml-2 text-sm tracking-wide truncate">Profile</span>
              <div id="dropdown" class="dropdown-content mt-3" style="display: none;">
                <a href="../certifications/certifications.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                  <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                    </svg>
                </span>
                  <span class="ml-2 text-sm tracking-wide truncate">Interns Profile</span>
                </a>
                <a href="../certifications/certifications.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                  <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 01-2.07-.655zM16.44 15.98a4.97 4.97 0 002.07-.654.78.78 0 00.357-.442 3 3 0 00-4.308-3.517 6.484 6.484 0 011.907 3.96 2.32 2.32 0 01-.026.654zM18 8a2 2 0 11-4 0 2 2 0 014 0zM5.304 16.19a.844.844 0 01-.277-.71 5 5 0 019.947 0 .843.843 0 01-.277.71A6.975 6.975 0 0110 18a6.974 6.974 0 01-4.696-1.81z" />
                    </svg>
                </span>
                  <span class="ml-2 text-sm tracking-wide truncate">Applicants Profile</span>
                </a>
              </div>
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
      <a href="../admin_dashboard.php" class="p-2 mr-auto inline-flex items-center">
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
      function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
          dropdown.style.display = "block";
        } else {
          dropdown.style.display = "none";
        }
      }
    </script>
  </body>
</html>