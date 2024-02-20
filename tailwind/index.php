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
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.min.js'></script>
    <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="script.js"></script>
    <link rel="icon" href="securities and exchange.png" type="image/x-icon">
    <title>Dashboard</title>
  </head>
  <body>
    <body class="flex bg-gray-100 min-h-screen">
      <div class="flex-grow text-gray-800">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-green-700">
          <a href="../tailwind/index.php" class="p-2 mr-auto inline-flex items-center">
        <img src="../dashboard/sec.png" alt="New Logo" class="h-3vh w-20 mr-2">
    </a>
          
          <div class="flex flex-shrink-0 items-center ml-auto">
            <button class="inline-flex items-center p-2 hover:bg-gray-500 focus:bg-gray-100 rounded-lg">
              <span class="sr-only">User Menu</span>
              <div class="hidden md:flex md:flex-col md:items-end md:leading-tight">
                <span class="font-semibold text-white"><?php echo $username; ?></span>
              </div>
              <span class="h-12 w-12 ml-2 sm:ml-3 mr-2 bg-gray-100 rounded-full overflow-hidden">
              <img width="47" height="48" src="https://img.icons8.com/fluency-systems-filled/48/user.png" alt="user"/>
            </span>
            </button>
            <div class="border-l pl-3 ml-3 space-x-1">
              <button class="relative p-2 text-white hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
                <span class="sr-only">Notifications</span>
                <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full"></span>
                <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full animate-ping"></span>
                <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
              </button>
              <button onclick="window.location.href='logout.php'" class="relative p-2 text-white hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
                <span class="sr-only">Log out</span>
                <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
              </button>
            </div>
          </div>
        </header>
        <main class="p-6 sm:p-10 space-y-6">
          <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
            <div class="mr-6">
              <h1 class="text-4xl font-semibold mb-2" style="font-family: 'Poppins'">Interns Dashboard</h1>
              <h2 class="text-gray-600 ml-0.5">SEC Internship Program</h2>
            </div>
            <div class="flex flex-wrap items-start justify-end -mb-3">
            </div>
          </div>
          <?php
              // include "../carousel.php";  
              ?>
          <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
              <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                <a href="../attendance/attendance form.php">
                  <img src="attendance.png" class="h-16 w-16 rounded-full" alt="Image 1">
                </a>
              </div>
              <div>
                <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Attendance</span>
              </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
              <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                <a href="../monthly reports/acomplishment_tab.php">
                  <img src="monthly reports.png" class="h-16 w-16 rounded-full" alt="Image 1">
                </a>
              </div>
              <div>
                <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Monthly reports</span>
              </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
              <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                <a href="../certifications/interns_certificate.php">
                  <img src="certification.png" class="h-16 w-16 rounded-full" alt="Image 1">
                </a>
              </div>
              <div>
                <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Certifications</span>
              </div>
            </div>
          </section>
          <section class="grid md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-3 xl:grid-flow-col gap-6">
            <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg w-full">
              <div class="px-6 py-5 font-semibold border-b border-gray-100 text-xl"  style = "font-family: 'Karma';">Calendar</div>
              <div class="p-4 flex-grow">
                <div class="container mx-auto">
                  <div class="flex justify-center">
                    <div class="w-full">
                      <div class="bg-white rounded-lg shadow-lg">
                        <div class="p-4">
                          <div id="calendar"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php
            // include "footers.php"
            ?>
        </main>
      </div>
    </body>
</html>
</body>
</html>