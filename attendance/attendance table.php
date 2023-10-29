<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Table</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Istok+Web">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Overpass">
  </head>
  <section class="py-1 bg-blueGray-50">
    <div class="w-full xl:w-100 mb-12 xl:mb-0 px-4 mx-auto mt-0">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="font-semibold text-base text-blueGray-700 text-xl" style="font-family: 'Montserrat', sans-serif;">Attendance Record</h3>
            </div>
            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
              <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                <select class="bg-green-900 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" onchange="filterTableByMonth(this.value)">
                  <option value="">Select Month</option>
                  <option value="January">January</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                  <option value="November">November</option>
                  <option value="December">December</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="block w-full overflow-x-auto">
          <table class="items-center bg-transparent w-full border-collapse">
            <thead>
              <tr>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style="font-family: 'Istok Web', sans-serif;">
                  Name
                </th>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style="font-family: 'Istok Web', sans-serif;">
                  Department
                </th>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style="font-family: 'Istok Web', sans-serif;">
                  Morning Time In
                </th>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style="font-family: 'Istok Web', sans-serif;">
                  Lunch Time out
                </th>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style=style="font-family: 'Istok Web', sans-serif;">
                  After lunch Time In
                </th>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style="font-family: 'Istok Web', sans-serif;">
                  End of the day Time Out
                </th>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style="font-family: 'Istok Web', sans-serif;">
                  Attendance date
                </th>
                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left" style="font-family: 'Istok Web', sans-serif;">
                  Rendered Hours
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
            if (isset($result) && $result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>". $row['name'] . "</td>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['department'] . "</td>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['morning_timein'] . "</td>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['lunch_timeout'] . "</td>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['after_lunch_timein'] . "</td>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['end_of_day_timeout'] . "</td>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['attendance_date'] . "</td>";
                        echo "<td class='py-2 px-4 border-b' style='font-family: Overpass, sans-serif;'>" . $row['rendered_hours'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='py-2 px-4'>No attendance records found.</td></tr>";
                }
            } else {
                echo "Error executing query: " . mysqli_error($conn);
            }
            ?>
            </tbody>
          </table>
        </div>

        <!-- Include Bootstrap JS and jQuery (optional) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.tailwindcss.com/2.2.19/tailwind.min.js"></script>
        <script src="script.js"></script>
        </body>
</html>