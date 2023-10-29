<?php
include "db config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Istok+Web">
</head>
<body class="flex bg-gray-100 min-h-screen ">
<aside class="hidden sm:flex sm:flex-col ">
        <a href="../tailwind/index.php" class="inline-flex items-center justify-center h-20 w-20 bg-green-900">
        <img src="sec.png" alt="Logo" class="h-16 w-16">
        </a>
        <div class="flex-grow flex flex-col justify-between text-gray-500 bg-green-800">
          <nav class="flex flex-col mx-4 my-6 space-y-4">
            <a href="#" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
              <span class="sr-only">Folders</span>
              <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
              </svg>
            </a>
            <a href="#" class="inline-flex items-center justify-center py-3 text-white  hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700">
              <span class="sr-only">Dashboard</span>
              <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
            </a>
            <a href="#" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
              <span class="sr-only">Messages</span>
              <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </a>
            <a href="#" class="inline-flex items-center justify-center py-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
              <span class="sr-only">Documents</span>
              <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
            </a>
          </nav>
          <div class="inline-flex items-center justify-center h-20 w-20 border-t border-gray-700">
            <button class="p-3 hover:text-gray-400 hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg">
              <span class="sr-only">Settings</span>
              <svg aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </button>
          </div>
        </div>
      </aside>
    <div class="container mx-auto mt-0 p-6 bg-white rounded-lg shadow-lg w-full xl:w-100 mb-12 xl:mb-0 px-4 mx-auto mt-0">
        <h1 class="text-3xl font-bold mb-6">Attendance Form</h1>
        <!-- Morning Time-In Form -->
        <form action="morning time in.php" method="post" class="mb-8">
            <div class="mb-4">
                <label for="morning_timein" class="block text-gray-700"style="font-family: 'Istok Web', sans-serif;">Time-In (Morning):</label>
                <input type="time" class="form-input mt-1 block w-full" id="morning_timein" name="morning_timein" required>
            </div>
            <button class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
        <img src="https://img.icons8.com/ios-filled/50/000000/submit-for-approval.png" alt="Submit Icon" class="w-4 h-4 mr-2">
        Submit
    </button>
        </form>

        <!-- Lunch Time-Out Form -->
        <form action="lunch out.php" method="post" class="mb-8">
            <div class="mb-4">
                <label for="lunch_timeout" class="block text-gray-700" style="font-family: 'Istok Web', sans-serif;">Time-Out (Lunch):</label>
                <input type="time" class="form-input mt-1 block w-full" id="lunch_timeout" name="lunch_timeout" required>
            </div>
            <button class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
        <img src="https://img.icons8.com/ios-filled/50/000000/submit-for-approval.png" alt="Submit Icon" class="w-4 h-4 mr-2">
        Submit
    </button>
        </form>

        <!-- After Lunch Time-In Form -->
        <form action="after lunch time in.php" method="post" class="mb-8">
            <div class="mb-4">
                <label for="after_lunch_timein" class="block text-gray-700"style="font-family: 'Istok Web', sans-serif;">Time-In (After Lunch):</label>
                <input type="time" class="form-input mt-1 block w-full" id="after_lunch_timein" name="after_lunch_timein" required>
            </div>
            <button class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
        <img src="https://img.icons8.com/ios-filled/50/000000/submit-for-approval.png" alt="Submit Icon" class="w-4 h-4 mr-2">
        Submit
    </button>
        </form>

        <!-- End of Day Time-Out Form -->
        <form action="end of day time out.php" method="post">
            <div class="mb-4">
                <label for="end_of_day_timeout" class="block text-gray-700" style="font-family: 'Istok Web', sans-serif;">Time-Out (End of Day):</label>
                <input type="time" class="form-input mt-1 block w-full" id="end_of_day_timeout" name="end_of_day_timeout" required>
            </div>
            <button class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
        <img src="https://img.icons8.com/ios-filled/50/000000/submit-for-approval.png" alt="Submit Icon" class="w-4 h-4 mr-2">
        Submit
    </button>
        </form>
    </div>
    <?php
    include "attendance table.php";
    ?>
    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.tailwindcss.com/2.2.19/tailwind.min.js"></script>
</body>
</html>
