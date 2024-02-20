<?php
  include "database.php";
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
  if (isset($_GET['email'])) {
    $email = $_GET['email'];
  } else {
    $email = "Unknown"; // Set a default value
  }
  // Check if the given_name parameter is set in the URL
  if (isset($_GET['given_name'])) {
    $given_name = $_GET['given_name'];
  } else {
    $given_name = "Unknown"; // Set a default value
  }
  include "../dashboard/admin_navs.php";
  $dbname = "interns_application";
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <title>Applicant Details</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <link href="../css/dist/bootstrap.min.css" rel="stylesheet">
      <link href="../css/dist/tailwind.min.css" rel="stylesheet">
      <script src="../css/dist/jquery.min.js"></script>
      <script src="../css/dist/bootstrap.bundle.min.js"></script>
      <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.7.570/build/pdf.min.js"></script>
    </head>
    <body>
      <section class="grid grid-cols-1 gap-3">
        <div class="container  p-4 flex">
          <?php
            if (isset($_GET["id"])) {
                $applicant_id = $_GET["id"];
                // Connect to the database
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Query to retrieve data from multiple tables
                $query = "SELECT a.given_name, a.middle_name, a.family_name, a.address, a.place_birth, a.birthday, a.age, a.gender, a.contact, a.landline, a.secondary_email, a.primary_email, f.school_id, f.regi, f.schedule, f.form1, f.form2, f.form3, f.form4, fn.school_name, fn.regi_name, fn.schedule_name, fn.form1_name, fn.form2_name, fn.form3_name, fn.form4_name
                        FROM files AS f
                        INNER JOIN application AS a ON f.id = a.id
                        INNER JOIN file_names AS fn ON f.file_id = fn.file_id
                        WHERE a.id = $applicant_id";
                $result = $conn->query($query);
                if ($result) {
                    if ($result->num_rows > 0) {
                        $data = $result->fetch_assoc();
                        ?>
          <div class='w-screen p-3 rounded-lg overflow-hidden'>
            <div class='flex justify-end'>

              <!-- Approve Button Form -->
              <form action='approve.php' method='post' class='mr-2'>
                <input type='hidden' name='applicant_id' value='<?php echo $applicant_id; ?>'>
                <button type='button' id='openModalBtn' data-bs-toggle='modal' data-bs-target='#modals' class='bg-green-600 text-white rounded-md md:w-28 md:h-auto font-semibold'>Level 1 Interview</button>
              </form>

              <!-- Modal for Approve Button -->
              <div class="modal fade" id="modals" tabindex="-1" aria-labelledby="modals" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-green-800 text-white" style="font-family: 'Lato', sans-serif; font-weight: bold;">
                      <h5 class="modal-title" id="modals" style="font-size: 20px;">Send Emails</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="email.php" method="POST" enctype="multipart/form-data" id="uploadForm">
                        <div class="mb-3 p-4 rounded-lg">
                          <input type="hidden" name="email" value="<?php echo $email; ?>">
                          <p class="text-lg font-semibold mb-2">Sent To: <?php echo $email; ?></p>
                          <label for="date" class="block mb-2 text-sm font-medium text-gray-600">Date:</label>
                          <input type="date" id="date" name="date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                          <label for="time" class="block mt-4 text-sm font-medium text-gray-600">Time:</label>
                          <input type="time" id="time" name="time" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                          <label for="url" class="block mt-4 text-sm font-medium text-gray-600">URL:</label><br>
                          <input type="url" id="url" name="url" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><br>
                          <label for="meetingId">Meeting ID:</label><br>
                          <input type="text" id="meetingId" name="meetingId" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><br>
                          <label for="passcode">Passcode:</label><br>
                          <input type="text" id="passcode" name="passcode" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><br>
                          <textarea id="emailMessage" name="emailMessage" rows="4" cols="50" class="w-full px-3 py-2 mt-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
  Hi Mr/Ms. <?php echo $given_name?>,<br>
  <br>
  Good day!<br>
  We want to inform you that after reviewing your application and requirements, we are excited to move forward with the Level 1 Interview to be conducted by the SEC Internship Program (SIP) Management Team.
  </textarea>
                          </textarea>
                        </div>
                        <button type="submit" class="bg-green-900 text-white rounded-lg w-20 h-10">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-1">
                <form action='decline.php' method='post'>
                  <input type='hidden' name='applicant_id' value='<?php echo $applicant_id; ?>'>
                  <button type='submit' class='bg-green-800 text-white rounded-md md:w-28 md:h-auto font-semibold'>Level 2 Interview</button>
                </form>

                <!-- Decline Button Form -->
                <form action='decline.php' method='post'>
                  <input type='hidden' name='applicant_id' value='<?php echo $applicant_id; ?>'>
                  <button type='submit' class='bg-red-900 text-white rounded-md md:w-28 md:h-auto font-semibold'>Other Concerns</button>
                </form>
              </div>
            </div>

            <!-- Applicant Information Display -->
            <h2 class='flex items-center text-2xl font-bold mt-8 text-gray-800 p-4'>
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='w-6 h-6 mr-2'>
                <path fill-rule='evenodd' d='M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z' clip-rule='evenodd' />
              </svg>About
            </h2>
            <p class='text-gray-700'>Given Name: <span class='font-semibold'><?php echo $data["given_name"]; ?></span></p>
            <p class='text-gray-700'>Middle Name: <span class='font-semibold'><?php echo $data["middle_name"]; ?></span></p>
            <p class='text-gray-700'>Family Name: <span class='font-semibold'><?php echo $data["family_name"]; ?></span></p>
            <p class='text-gray-700'>Address: <span class='font-semibold'><?php echo $data["address"]; ?></span></p>
            <p class='text-gray-700'>Place of Birth: <span class='font-semibold'><?php echo $data["place_birth"]; ?></span></p>
            <p class='text-gray-700'>Birthday: <span class='font-semibold'><?php echo $data["birthday"]; ?></span></p>
            <p class='text-gray-700'>Age: <span class='font-semibold'><?php echo $data["age"]; ?></span></p>
            <p class='text-gray-700'>Gender: <span class='font-semibold'><?php echo $data["gender"]; ?></span></p>
            <p class='text-gray-700'>Contact: <span class='font-semibold'><?php echo $data["contact"]; ?></span></p>
            <p class='text-gray-700'>Landline: <span class='font-semibold'><?php echo $data["landline"]; ?></span></p>
            <p class='text-gray-700'>Secondary Email: <span class='font-semibold'><?php echo $data["secondary_email"]; ?></span></p>
            <p class='text-gray-700'>Primary Email: <span class='font-semibold'><?php echo $data["primary_email"]; ?></span></p>
          </div>
        </div>

        <!-- Files Information Display -->
        <div class='container h-auto mx-auto p-4  rounded-lg overflow-hidden'>
          <h2 class='text-2xl font-bold mt-8 text-gray-800 p-4'>File Submitted</h2>
          <div class='p-4'>
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Type</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Name</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Download</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">View</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php
                          function displayFile($fileType, $fileName, $applicantId, $buttonId)
                          {
                              echo "<tr>";
                              echo "<td class='px-6 py-4 whitespace-nowrap'>$fileType</td>";
                              echo "<td class='px-6 py-4 whitespace-nowrap'>$fileName</td>";
                              echo "<td class='px-6 py-4 whitespace-nowrap'><a href='download.php?id=$applicantId&type=$fileType' class='text-blue-500 hover:underline'><i class='fas fa-download'></i></a></td>";
                              echo '<td><button onclick="openModal(' . $applicantId . ', \'' . $fileType . '\')" class="bg-blue-500 text-white p-2 ml-4">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0  0  24  24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link">
                                  <path d="M18  13v6a2  2  0  0  1-2  2H5a2  2  0  0  1-2-2V7a2  2  0  0  1  2-2h6"></path>
                                  <polyline points="15  3  21  3  21  9"></polyline>
                                  <line x1="10" y1="14" x2="21" y2="3"></line>
                              </svg>
                              Open Modal
                          </button></td>';

                              echo "</tr>";
                          }
                          displayFile("school_id", $data["school_name"], $applicant_id, "school_id");
                          displayFile("regi", $data["regi_name"], $applicant_id, "regi");
                          displayFile("schedule", $data["schedule_name"], $applicant_id, "schedule");
                          displayFile("form1", $data["form1_name"], $applicant_id, "form1");
                          displayFile("form2", $data["form2_name"], $applicant_id, "form2");
                          displayFile("form3", $data["form3_name"], $applicant_id, "form3");
                          displayFile("form4", $data["form4_name"], $applicant_id, "form4");
                      ?>
              </tbody>
            </table>
          </div>
          <div id="myModal" class="fixed inset-0 items-center justify-center z-50 bg-black bg-opacity-50 hidden overflow-y-auto" data-modal-toggle>
            <div class="bg-white rounded-lg shadow-lg p-6 space-y-4 w-full max-w-md relative mx-auto my-auto mt-3">

              <!-- Close button -->
              <button class="absolute top-0 right-0 p-2 text-gray-700 hover:bg-gray-200 rounded-full" onclick="closeModal()">&times;</button>

              <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t">
      <h3 class="text-lg font-bold text-gray-900">PDF Viewer</h3>
    </div>
              <!-- Navigation buttons -->
              <div class="flex space-x-2">
              <button id="prev" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Previous</button>
              <button id="next" class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Next</button>
              <button id="zoomIn" class="btn bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">+</button>
              <button id="zoomOut" class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">-</button>
              </div>

              <!-- Canvas -->
              <div class="flex items-center justify-center w-full">
                <canvas id="pdf_canvas" class="w-auto h-auto overflow-y-auto border border-gray-200"></canvas>
              </div>

              <!-- Page indicator -->
              <div class="text-center">
                <span>Page: </span>
                <span id="page_num" class="font-bold"></span>
                <span>/</span>
                <span id="page_count" class="font-bold"></span>
              </div>
            </div>
          </div>
        </div>
        <?php
                    } else {
                        echo "<p class='text-red-500'>Applicant not found.</p>";
                    }
                } else {
                    echo "<p class='text-red-500'>Error executing query: " . $conn->error . "</p>";
                }
                // Close the database connection
                $conn->close();
            } else {
                echo "<p class='text-red-500'>Invalid request.</p>";
            }
            ?>
        </div>
      </section>
      <script>
              function openModal(ApplicantId, fileType) {
              console.log('Opening modal...');
              
              // Use fadeIn to animate the modal appearing
              $('#myModal').fadeIn('fast', function() {
                const pdfResult = fetchPdf(ApplicantId, fileType);
                console.log(pdfResult);
              });
            }
          function closeModal() {
          console.log('Closing modal...');
          
          // Use fadeOut to animate the modal disappearing
          $('#myModal').fadeOut('fast', function() {
            document.getElementById('myModal').style.display = 'none';

          });
        }
        var pageNum = 1;
        var totalNumPages = 0;
        function updatePageNumber() {
          document.getElementById('page_num').textContent = pageNum;
        }
        function fetchPdf(applicantId, fileType) {
          // console.log('Fetching PDF...');
          var scale = 1.3;
          var canvas = document.getElementById("pdf_canvas");
          var ctx = canvas.getContext('2d');
          // Use AJAX to fetch the PDF content dynamically with parameters
          fetch(`view.php?applicant_id=${applicantId}&file_type=${fileType}`)
            .then(response => {
              if (!response.ok) {
                throw new Error('Network response was not ok');
              }
              return response.blob();
            })
            .then(blob => {
              // Assuming blob contains the PDF content
              var pdfData = URL.createObjectURL(blob);
              pdfjsLib.getDocument({
                url: pdfData
              }).promise.then((doc) => {
                console.log('PDF Document:', doc);
                // Use getPagePromise instead of getPage
                doc.getPage(pageNum).then((page) => {
                  var viewport = page.getViewport({
                    scale: scale
                  });
                  canvas.height = viewport.height;
                  canvas.width = viewport.width;
                  var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                  };
                  var renderTask = page.render(renderContext);
                  renderTask.promise.then(() => {
                    // Handle rendering completion as needed
                    onRenderComplete();
                  });
                });
                totalNumPages = doc.numPages;
                updatePageNumber();
              });
            })
            .catch(error => {
              console.error('Error fetching PDF:', error);
            });
          // Placeholder for the rendering completion handler
          function onRenderComplete() {}
        }
      </script>
    </body>
  </html>