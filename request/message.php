<!DOCTYPE html>
<html>
  <head>
    <title>Request History</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src = "../css/dist/jquery.mim.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro&display=swap" rel="stylesheet">
    <style>
      #modal-overlay {
        pointer-events: none;
      }
      .modal-open #modal-overlay {
        pointer-events: auto;
      }
      .modal-open body {
        overflow: hidden;
      }
    </style>
  </head>
  <body>
    <?php
include "../dashboard/admin_navs2.php";
$server = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";
if(isset($_GET['username']) && isset($_GET['id'])){
    $username = $_GET['username'];
    $id = $_GET['id'];

}
$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// SQL query to retrieve description and message from reports_request table
$sql = "SELECT date, message FROM reports_request WHERE username = '$username' AND id = '$id'";
$result = $conn->query($sql);
if ($result) {
    if ($result->num_rows > 0) {
        ?>
    <div class="container mx-auto md:mt-10 p-4">
      <h1 class="text-2xl font-bold mb-4">Request History</h1>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="bg-gray-200 p-4 rounded-lg border-2 border-gray-300 mb-4">
        <p class="text-gray-600 text-sm">Received on: <?php echo $row['date']; ?></p>
        <p class="text-gray-800 mt-2 font-serif text-lg leading-relaxed" style = "font-family: 'Maven pro', sans-serif;"><?php echo $row['message']; ?></p>
        <div class="flex justify-end">
          <div class="flex justify-end">
            <a href="#" class="flex items-center" id="open-modal">
              <div class="w-6 h-6 text-green-800 mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                </svg>
              </div>
            </a>
          </div>
          <div class="flex justify-end">
            <a href="#" class="flex items-center" id="open-modal">
              <div class="w-6 h-6 text-red-700 mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                </svg>
              </div>
            </a>
          </div>
          <button class="bg-green-900 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">Accept</button>
          <button class="bg-red-900 hover:bg-red-700 text-white font-bold py-2 px-4 ml-3 rounded">Decline</button>
        </div>
      </div>
      <?php } ?>
      <div id="my-modal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-96">

        <form method="POST" action="submit.php" name="requestForm">
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
          <h2 id="modal-title" class="text-xl font-bold mb-4">Re open of Submission</h2>
          <p class="text-gray-800">Choose a month to re-open Monthly reports submission</p>
          <div class="relative inline-block mt-4">
            <button  type = "button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
              <span id="selectedOption">Dropdown</span>
              <svg class="fill-current h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M10 12l-6-6h12l-6 6z" />
              </svg>
            </button>
            <ul id="dropdown" class="absolute hidden text-gray-700 pt-1 max-h-40 overflow-y-scroll">
              <li value="january" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">January</li>
              <li value="february" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">February</li>
              <li value="march" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">March</li>
              <li value="april" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">April</li>
              <li value="may" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">May</li>
              <li value="june" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">June</li>
              <li value="july" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">July</li>
              <li value="august" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">August</li>
              <li value="september" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">September</li>
              <li value="octiber" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">October</li>
              <li value="november" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">November</li>
              <li value="december" class="bg-white hover:bg-green-800 hover:text-white py-2 px-4 cursor-pointer">December</li>
            </ul>
          </div>
          <input type="hidden" name="selectedMonth" id="selectedMonth" value="">
          <button type = "button"  id="close-modal" class=" hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded absolute top-0 right-0 mt-4 mr-4">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M10.707 10l3.536-3.536a1 1 0 0 0-1.414-1.414L10 8.586 6.464 5.05a1 1 0 0 0-1.414 1.414L8.586 10l-3.536 3.536a1 1 0 0 0 1.414 1.414L10 11.414l3.536 3.536a1 1 0 0 0 1.414-1.414L11.414 10l3.536-3.536a1 1 0 0 0-1.414-1.414L10 8.586z" />
            </svg>
          </button>
          </button>
          <button type = "submit" id="submitBtn" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Submit</button>
        </div>
      </div>
      <div id="modal-overlay" class="fixed top-0 left-0 w-screen h-screen bg-black opacity-50 z-40 hidden"></div>
    </div>
      </form>
    <?php
    } else {
        ?>
    <div class="flex justify-center mt-10 h-96">
      <div class="container mx-auto h-96">
        <div class="bg-gray-200 p-4 rounded-lg border-2 border-gray-100">
          <p class="text-gray-800 font-serif text-1xl">Nothing to show here</p>
        </div>
      </div>
    </div>
    <?php
    }
} else {
    echo "Error executing query: " . $conn->error;
}
// Close the connection
$conn->close();
?>
    <script>
$(document).ready(function() {
  const openModalButton = $("#open-modal");
  const closeModalButton = $("#close-modal");
  const myModal = $("#my-modal");
  const modalOverlay = $("#modal-overlay");

  // Function to show the modal with overlay
  function showModal() {
    $("body").addClass("modal-open");
    myModal.fadeIn();
    modalOverlay.fadeIn();
  }

  // Function to hide the modal and overlay
  function hideModal() {
    $("body").removeClass("modal-open");
    myModal.fadeOut();
    modalOverlay.fadeOut();
  }

  // On button click, show the modal with overlay
  openModalButton.click(function(e) {
    e.preventDefault();
    showModal();
  });

  // On close button click, hide the modal and overlay
  closeModalButton.click(function() {
    hideModal();
  });

  const dropdown = document.getElementById('dropdown');
  const selectedOption = document.getElementById('selectedOption');
  const selectedMonthInput = document.getElementById('selectedMonth');

  // On dropdown item click, update the selected option and hidden input field
  dropdown.addEventListener('click', function(event) {
    event.preventDefault();
    const selectedValue = event.target.getAttribute('value');
    const selectedText = event.target.textContent;

    selectedOption.textContent = selectedText;
    selectedOption.setAttribute('data-value', selectedValue);
    
    // Update the hidden input field with the selected value
    selectedMonthInput.value = selectedValue;
  });
});

    </script>
  </body>
</html>