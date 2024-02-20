<?php
include "header/header.php"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=" css/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/fullcalendar/main.min.css">
    <script src="node_modules/moment/min/moment.min.js"></script>
    <script src="node_modules/fullcalendar/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- <script src="script.js"></script> -->
    <title>Dashboard</title>
  </head>
  <body class="bg-gray-100 h-auto">
    <div class="flex-grow text-gray-800">
      <header class="flex items-center h-20 px-6 sm:px-10 bg-green-800">
        <a href="admin_dashboard.php" class="p-2 mr-auto inline-flex items-center">
          <img src="dashboard/sec.png" alt="New Logo" class="h-3vh w-20 mr-2">
        </a>
        <div class="relative w-full max-w-md sm:-ml-2">
          <svg aria-hidden="true" viewbox="0 0 20 20" fill="currentColor" class="absolute h-6 w-6 mt-2.5 ml-2 text-gray-400">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
          </svg>
          <input type="text" role="search" placeholder="Search..." class="py-2 pl-10 pr-4 w-full border-4 border-transparent placeholder-gray-400 focus:bg-gray-50 rounded-lg" />
        </div>
        <div class="flex flex-shrink-0 items-center ml-auto">
          <button class="inline-flex items-center p-2 hover:bg-gray-700 focus:bg-gray-600 rounded-lg">
            <span class="sr-only">User Menu</span>
            <div class="hidden md:flex md:flex-col md:items-end md:leading-tight">
              <span class="font-semibold text-white uppercase"><?php echo $username; ?></span>
            </div>
            <span class="h-12 w-12 ml-2 sm:ml-3 mr-2 bg-gray-100 rounded-full overflow-hidden">
              <img width="50" height="50" src="tailwind/user.svg" alt="pdf" class="" />
              </span>
          </button>
          <div class="border-l pl-3 ml-3 space-x-1">
            <button class="relative p-2 text-white  hover:bg-gray-700 hover:text-gray-700 focus:bg-gray-800 focus:text-gray-600 rounded-full">
              <span class="sr-only">Notifications</span>
              <img src="tailwind/notifications.svg" alt="Description of image" class="w-6 h-6">
            </button>
            <button onclick="window.location.href='interns account/add.php'" class="relative p-2 text-white hover:bg-gray-700 hover:text-gray-800 focus:bg-gray-800 focus:text-gray-600 rounded-full">
              <span class="sr-only">Add</span>
              <img src="tailwind/add.svg" alt="Description of image" class="w-6 h-6">
            </button>
            <button onclick="window.location.href='interns account/add_image.php'" class="relative p-2  hover:bg-gray-700 focus:bg-gray-800 focus:text-gray-800 rounded-full">
              <span class="sr-only">Add Image</span>
              <img src="tailwind/image.svg" alt="Description of image" class="w-6 h-6">
            </button>
            <button onclick="window.location.href='dashboard/logout.php'" class="relative p-2 text-white hover:bg-gray-700 hover:text-gray-800 focus:bg-gray-800 focus:text-gray-600 rounded-full">
              <span class="sr-only">Log out</span>
              <img src="tailwind/logout.svg" alt="Description of image" class="w-6 h-6">
            </button>
          </div>
        </div>
      </header>
      <main class="p-6 sm:p-10 space-y-6">
        <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
          <div class="mr-6">
            <h1 class="text-4xl font-semibold mb-2" style="font-family: 'Poppins'">Admin Dashboard</h1>
            <h2 class="text-gray-600 ml-0.5">SEC Internship Program</h2>
          </div>
          <div class="flex flex-wrap items-start justify-end -mb-3">
          </div>
        </div>
        <?php
              include "carousel.php"
              ?>
        <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 sm:grid-cols-1 sm:overflow-x-auto">
          <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
              <a href="attendance/display attendance.php">
                <img src="tailwind/attendance.png" class="h-16 w-16 rounded-full" alt="Image 1">
              </a>
            </div>
            <div>
              <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Attendance</span>
            </div>
          </div>
          <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
              <a href="monthly reports/reports_table.php">
                <img src="tailwind/monthly reports.png" class="h-16 w-16 rounded-full" alt="Image 1">
              </a>
            </div>
            <div>
              <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Monthly reports</span>
            </div>
          </div>
          <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
              <a href="certifications/certifications.php">
                <img src="tailwind/certification.png" class="h-16 w-16 rounded-full" alt="Image 1">
              </a>
            </div>
            <div>
              <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Certifications</span>
            </div>
          </div>
          <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
              <a href="application forms/interns_table.php">
                <img src="tailwind/application.png" class="h-16 w-16 rounded-full" alt="Image 1">
              </a>
            </div>
            <div>
              <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Application</span>
            </div>
          </div>
          <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
              <a href="request/request history.php">
                <img src="tailwind/request.png" class="h-16 w-16 rounded-full" alt="Image 1">
              </a>
            </div>
            <div>
              <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">Request History </span>
            </div>
          </div>
          <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
              <a href="attendance/qr generate.php">
                <img src="tailwind/qr.png" class="h-16 w-16 rounded-full" alt="Image 1">
              </a>
            </div>
            <div>
              <span class="block text-gray-900 text-xl font-bold" style = "font-family: 'Karma';">QR</span>
            </div>
          </div>
        </section>
        <section class="grid md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-2 xl:grid-flow-col-2 gap-6">
          <div class="flex flex-col md:col-span-2 bg-white shadow rounded-lg">
            <section class="grid grid-cols-2 gap-4 items-center">
              <div class="px-6 py-5 font-semibold border-b border-gray-100 text-3xl" style="font-family: 'Karma';">Calendar</div>
              <div class="flex justify-end mr-6 mt-4">
                <button onclick="modalOpen('myModal')" type="button" class="md:w-21 text-white uppercase bg-green-600 hover:bg-green-800 focus:ring-4 font-bold focus:outline-none focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 [dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring]-blue-800 md:mb-12 relative">
                  <span class="mr-2">Add Event</span>
                </button>
              </div>
            </section>
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
          <div id="myModal" class="fixed inset-0 items-center justify-center z-50 bg-black bg-opacity-50 hidden">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="transition duration-500 w-max ease-in-out border border-gray-300 rounded bg-blue-200  p-6 shadow-lg max-w-lg mx-auto">
                    <div class="flex items-center justify-between px-6 py-5 font-semibold border-b border-gray-100">
                      <div class="card">
                        <span class = "text-3xl font-bold text-green-700 p-4 m-4" style = "font-family: 'Karma';">Add Event</span>
                        <div class="cursor-pointer z-50" onclick="modalClose('myModal')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                          </svg>
                        </div>
                        <div class="card-body">
                          <form id="eventForm" action="admin_addevents.php" method="POST" class="flex flex-col space-y-4">
                            <div class="form-group">
                              <label for="event_name" class="block mb-2 text-sm font-medium text-white uppercase">Event Name:</label>
                              <input type="text" class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none py-2 px-3" id="event_name" name="event_name" placeholder="Enter event name" required>
                            </div>
                            <div class="form-group">
                              <label for="event_time" class="block mb-2 text-sm font-medium text-white uppercase">Event Time:</label>
                              <input type="datetime-local" class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none py-2 px-3" id="event_time" name="event_time" required>
                            </div>
                            <button type="submit" class="w-full bg-green-900 font-bold text-white py-2 px-4 rounded">Add Event</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-col md:col-span-2 md:h-auto w-auto lg:h-50 bg-white shadow-md rounded-lg justify-start">
            <div class="px-6 py-5 font-semibold border-b border-gray-100 text-3xl justify-start" style="font-family: 'Karma';">Interns Data</div>
            <div class="grid md:grid-cols-1 gap-y-5 item-center justify-center mx-auto">
              <div class="w-full mx-auto  bg-white rounded-xl shadow-md overflow-hidden">
                <img class="w-full h-32 object-cover" src="tailwind/applicant.png" alt="applcants_data">
                <div class="p-4">
                  <h2 class="text-lg font-semibold text-gray-800">Applicants Data</h2>
                  <p class="text-gray-600 mt-2">Check the Total numbers of Applicant here by checking the visual charts representation</p>
                  <div class="flex items-center mt-2">
                    <button class="ml-auto px-3 py-1 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Check</button>
                  </div>
                </div>
              </div>
              <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                <img class="w-full h-32 object-cover" src="tailwind/interns.jpg" alt="interns data">
                <div class="p-4">
                  <h2 class="text-lg font-semibold text-gray-800">Interns Data</h2>
                  <p class="text-gray-600 mt-2">Check the Total numbers of Active Interns here by checking the visual charts representation</p>
                  <div class="flex items-center mt-2">
                  <a href="charts/interns_data.php" class="ml-auto px-3 py-1 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Check</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div id="eventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition duration-300 ease-in-out transform scale-100 origin-center">
      <div class="modal-content bg-white p-6 rounded shadow-lg w-full max-w-md transition-transform duration-300 ease-in-out transform scale-100">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-2xl font-bold text-gray-900 text-center">Events</h2>
        </div>
        <hr class="border-t border-gray-200 my-4">
        <dl class="space-y-4">
          <dt class="text-md font-semibold text-gray-900">Event Title:</dt>
          <dd id="eventTitle" class="text-base text-gray-700"></dd>
          <dt class="text-md font-semibold text-gray-900">Event Start:</dt>
          <dd id="eventStart" class="text-base text-gray-700"></dd>
        </dl>
        <button id="closeModalBtn" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-colors duration-200 ease-in-out" type="button">
          Close
        </button>
      </div>
    </div>
    </div>
    </section>
    </main>
    </div>
    <script>
      function modalOpen(id) {
        document.getElementById(id).style.display = 'flex';
      }
      function modalClose(id) {
        document.getElementById(id).style.display = 'none';
      };
    </script>
    <!-- <script src="chart.js"></script> -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: 'fetch_events.php',
          eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: 'short'
          },
          eventClick: function(info) {
            openModal(info.event.title, info.event.start);
          }
        });
        calendar.render();
        function openModal(title, start) {
          var modal = document.getElementById('eventModal');
          modal.classList.remove('hidden');
          document.getElementById('eventTitle').textContent = title;
          document.getElementById('eventStart').textContent = `Start: ${moment(start).format('YYYY-MM-DD HH:mm')}`;
          document.getElementById('closeModalBtn').addEventListener('click', function() {
            modal.classList.add('hidden');
          });
        }
        // Handle form submission to add events
        $('#eventForm').on('submit', function(event) {
          event.preventDefault();
          var eventData = {
            title: $('#event_name').val(),
            start: moment($('#event_time').val()).format('YYYY-MM-DD HH:mm'),
            allDay: true
          };
          $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
              if (response.success) {
                calendar.addEvent(eventData);
                $('#event_name').val('');
                $('#event_time').val('');
              } else {
                console.log(response.error);
              }
            },
            error: function(xhr, status, error) {
              console.log(error);
            }
          });
        });
      });
    </script>
  </body>
</html>
</body>
</html>