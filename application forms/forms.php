<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>
  <body class="bg-gray-200">
    <?php include "template.html"; ?>
    <div class=" p-6 rounded shadow min-h-screen overflow-hidden flex items-center justify-center" id="page1">
      <div class="bg-white w-full max-w-xl p-6 rounded shadow maoverflow-y-auto">
        <p class="text-2xl font-bold text-center mb-4 text-gray-800">Dear Applicant,</p>
        <p class="text-gray-700 mb-4">Greetings from the Securities and Exchange Commission!</p>
        <p class="text-gray-700 mb-4">We are pleased to know that you are considering applying to the SEC Internship Program. The SEC Internship Program is a unique learning opportunity that brings together highly qualified and motivated students with diverse backgrounds into the Securities and Exchange Commission to gain direct practical experience designed to transform them into prospective professionals capable of applying theoretical knowledge in the workplace. At the same time, the internship program ensures, where possible, optimal use of the student-intern's aptitude with a view to contributing to the improved management of the workload of the SEC.</p>
        <p class="text-gray-700 mb-4">The SEC evaluates applications based on: eligibility requirements, relevance of academic study, and the level of interest and motivation to contribute to the work of the agency. The SEC also considers institutional representation and gender in the overall intern selection process.</p>
        <p class="text-gray-700 mb-4">Only shortlisted candidates will be contacted.</p>
        <p class="text-gray-700 mb-4">Thank you and good luck!</p>
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200 ease-in-out next-page" data-next="page2" onclick="goToSecondPage()" type="button">Next</button>
      </div>
    </div>
    <div id="myModal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" style="display: none;">
      <div class="bg-white p-4 rounded shadow mx-auto mt-20 max-w-md" style="max-width:   500px;">
        <div>
          <h2 class="text-2xl font-bold mb-4 text-center" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Terms and Privacy</h2>
          <p class="mb-4 text-sm leading-6">The Securities and Exchange Commission (SEC)...</p>
          <p class="mb-4 text-sm leading-6">By filling out this form and providing us with your personal and other essential details, you are freely giving your informed consent to our capture, recording, processing, and use of personal information that we will gather from you. Rest assured that we will safeguard your sensitive personal information, uphold your privacy, and ensure at all times the confidentiality of such that comes to its knowledge and possession in accordance with the Data Privacy Act of 2012.</p>
          <button id="accept" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">I Understand</button>
        </div>
      </div>
    </div>
    <div class="form-page hidden p-8" id="page2">
      <div class="flex justify-center card flex-row flex-wrap gap-4 p-8 sm:p-12 md:p-10 lg:p-10 xl:p-10 2xl:p-20 bg-white text-gray-900 shadow-lg rounded-md md:max-w-4xl mx-auto md:max-h-5xl mt-8">
        <form id = "form-submission" action="submit.php" method="POST" enctype="multipart/form-data">
          <h1 class="flex mb-7 uppercase justify-center text-2xl font-bold">Personal Details</h1>
          <div class="grid grid-cols-1 xl:grid-cols-6 gap-4 max-w-2xl ">
            <div class="col-span-2">
              <label for="given_name" class="block text-sm font-medium text-gray-700 mb-1">Given Name</label>
              <input type="text" name="given_name" id="given_name" placeholder="Your answer" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
              <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
              <input type="text" name="middle_name" id="middle_name" placeholder="Your answer" class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
              <label for="family_name" class="block text-sm font-medium text-gray-700 mb-1">Family Name</label>
              <input type="text" name="family_name" id="family_name" placeholder="Your answer" class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
              <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Complete Home Address</label>
              <input type="text" name="address" id="address" placeholder="Your answer" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
              <label for="place_birth" class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
              <input type="text" name="place_birth" id="place_birth" placeholder="Your answer" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
          <label for="birthday" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
          <input type="date" name="birthday" id="birthday" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
      </div>

            <div class="col-span-3">
              <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age</label>
              <input type="text" name="age" id="age" placeholder="Your answer" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-3">
              <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Sex</label>
              <select name="gender" id="gender" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="col-span-2">
              <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
              <input type="text" name="contact" id="contact" placeholder="Your answer" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
              <label for="landline" class="block text-sm font-medium text-gray-700 mb-1">Contact Number (Landline)</label>
              <input type="text" name="landline" id="landline" placeholder="Your answer" class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
              <label for="primary_email" class="block text-sm font-medium text-gray-800 mb-1">Primary Email Address</label>
              <input type="email" name="primary_email" id="primary_email" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="col-span-2">
              <label for="secondary_email" class="block text-sm font-medium text-gray-700 mb-1">Secondary Email Address</label>
              <input type="email" name="secondary_email" id="secondary_email" required class="mt-1 p-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
            </div>
          </div>
          <div class="flex justify-center items-center mt-7 w-full">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l shadow-md transition duration-200 ease-in-out" data-prev="page1" onclick="goToFirstPage()" type="button">
              <i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous
            </button>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-r shadow-md transition duration-200 ease-in-out" data-next="page3" onclick="goToThirdpage()" type="button">
              Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </button>
          </div>
      </div>
    </div>
    <div class="hidden form-page p-8" id="page3">
      <div class="flex justify-center">
        <div class="card bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
          <h1 class="text-3xl font-bold mb-6 text-center">Required Forms</h1>
          <p class="text-gray-600 font-semibold text-sm leading-snug tracking-wide mb-3">
            Note: Please submit the required documents in <span class="text-red-600">PDF</span> format only.
          </p>
          <div class = "overflow-y-auto max-h-60">
          <label for="school_id" class="text-gray-700 text-sm">Upload your School ID</label>
          <label for="school_id" class="flex items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke="currentColor" class="h-16 w-auto text-gray-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12  6v6m0  0v6m0-6h6m-6  0H6" />
            </svg>
            <div class="space-y-2">
              <h4 class="text-base font-semibold text-gray-700">Upload School ID</h4>
              <span id="idfileName" class="text-sm text-gray-500"></span>
            </div>
            <input type="file" id="school_id" name="school_id" accept=".pdf" hidden required onchange="showFileName(this.files, 'idfileName')">
          </label>
          <label for="regi" class="text-gray-700 text-sm">Upload your Certificate of Registration</label>
          <label for="regi" class="flex items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke="currentColor" class="h-16 w-auto text-gray-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12  6v6m0  0v6m0-6h6m-6  0H6" />
            </svg>
            <div class="space-y-2">
              <h4 class="text-base font-semibold text-gray-700">Registration form</h4>
              <span id="registrationfileName" class="text-sm text-gray-500"></span>
            </div>
            <input accept=".pdf" type="file" name="regi" id="regi" hidden required onchange="showFileName(this.files, 'registrationfileName')"><br>
          </label>

          <label for="schedule" class="text-gray-700 text-sm">Upload your Schedule</label>
          <label for="schedule" class="flex items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke="currentColor" class="h-16 w-auto text-gray-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12  6v6m0  0v6m0-6h6m-6  0H6" />
            </svg>
            <div class="space-y-2">
              <h4 class="text-base font-semibold text-gray-700">School Schedule</h4>
              <span id="schoolfileName" class="text-sm text-gray-500"></span>
            </div>
            <input accept=".pdf" type="file" name="schedule" id="schedule" hidden required onchange="showFileName(this.files, 'schoolfileName')"><br>
          </label>

          <label for="form1" class="text-gray-700 text-sm">SIP Form 101 – Internship Application Form</label>
          <label for="form1" class="flex items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke="currentColor" class="h-16 w-auto text-gray-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12  6v6m0  0v6m0-6h6m-6  0H6" />
            </svg>
            <div class="space-y-2">
              <h4 class="text-base font-semibold text-gray-700">Form 1</h4>
              <span id="filename1" class="text-sm text-gray-500"></span>
            </div>
            <input accept=".pdf" type="file" name="form1" id="form1" style="display: none;" required onchange="showFileName(this.files, 'filename1')">
          </label>

          <label for="form2" class="text-gray-700 text-sm">SIP Form 102 – Essay Questionnaire</label><label for="form1" class="text-gray-700 text-sm">SIP Form 101 – Internship Application Form</label>
          <label for="form2" class="flex items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke="currentColor" class="h-16 w-auto text-gray-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12  6v6m0  0v6m0-6h6m-6  0H6" />
            </svg>
            <div class="space-y-2">
              <h4 class="text-base font-semibold text-gray-700">Form 2</h4>
              <span id="filename2" class="text-sm text-gray-500"></span>
            </div>
            <input accept=".pdf" type="file" name="form2" id="form2" required hidden required onchange="showFileName(this.files, 'filename2')"><br>
          </label>
          <label for="form3" class="text-gray-700 text-sm">SIP Form 103 – Essay Questionnaire</label>
          <label for="form3" class="flex items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke="currentColor" class="h-16 w-auto text-gray-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12  6v6m0  0v6m0-6h6m-6  0H6" />
            </svg>
            <div class="space-y-2">
              <h4 class="text-base font-semibold text-gray-700">Form 3</h4>
              <span id="filename3" class="text-sm text-gray-500"></span>
            </div>
            <input accept=".pdf" type="file" name="form3" id="form3" hidden required onchange="showFileName(this.files, 'filename3')"><br>
          </label>
          <label for="form4" class="text-gray-700 text-sm">SIP Form 104 – Personal Data Sheet (CSC Form No. 212, Rev 2017)</label>
          <label for="form4" class="flex items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke="currentColor" class="h-16 w-auto text-gray-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12  6v6m0  0v6m0-6h6m-6  0H6" />
            </svg>
            <div class="space-y-2">
              <h4 class="text-base font-semibold text-gray-700">Form 4</h4>
              <span id="filename4" class="text-sm text-gray-500"></span>
            </div>
            <input accept=".pdf" type="file" name="form4" id="form4" hidden require onchange="showFileName(this.files, 'filename4')">
            <label><br>
         </div>
              <div class="flex justify-center items-center mt-6 space-x-4">
                <button class="prev-page bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 active:bg-gray-700 transition duration-150 ease-in-out" data-prev="page2" onclick="goToPrevPage()" type="button">
                  <i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous
                </button>
                <button onclick="submitForm()"  class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-r shadow-md transition duration-200 ease-in-out" type="submit" value="<?php echo $_SESSION['form_token']; ?>">
                  Submit
                </button>
              </div>
        </div>
      </div>
    </div>
    </form>
    </div>
    <div id="customModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-75" style="display: none;">
    <div class="bg-white p-6 rounded shadow-md">
        <div id="modalContent"></div>
        <button onclick="closeModal()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Close</button>
    </div>
</div>

    <!-- <script src="app.js"></script> -->
    <script>
      var modal = document.getElementById("myModal");
      var acceptBtn = document.getElementById("accept");
      // Check if modal and acceptBtn exist
      if (modal && acceptBtn) {
        // Show the modal on load
        window.onload = function() {
          modal.style.display = "block";
        };
        // Hide the modal when the accept button is clicked
        acceptBtn.onclick = function(event) {
          event.preventDefault(); // Prevent any default action
          modal.style.display = "none";
        };
        // Hide the modal when clicking outside of it
        modal.addEventListener('click', function(event) {
          if (event.target === this) {
            modal.style.display = "none";
          }
        }, false);
      };
      // Function to handle showing the next page
      function goToSecondPage() {
        document.getElementById('page1').classList.add('hidden');
        document.getElementById('page2').classList.remove('hidden');
      }
      function goToFirstPage() {
        // Correctly capitalized 'classList'
        document.getElementById('page2').classList.add('hidden');
        document.getElementById('page1').classList.remove('hidden');
      }
      function goToThirdpage() {
        document.getElementById('page2').classList.add('hidden');
        document.getElementById('page3').classList.remove('hidden');
      }
      function goToPrevPage() {
        document.getElementById('page3').classList.add('hidden');
        document.getElementById('page2').classList.remove('hidden');
      }
      function showFileName(files, spanId) {
      var fileNameSpan = document.getElementById(spanId);
      if (files && files.length >  0) {
        fileNameSpan.textContent = files[0].name;
      } else {
        fileNameSpan.textContent = '';
      }
    }
 // Your form submission function
 function submitForm() {
        $.ajax({
            url: 'submit.php', // Replace with the actual path to your PHP script
            type: 'POST',
            data: new FormData($('#form-submission')[0]),
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle the JSON response
                handleResponse(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while submitting the form.');
            }
        });
    }

    // Function to handle the JSON response
    function handleResponse(response) {
        // Parse the JSON response
        try {
            var data = JSON.parse(response);
            if (data.status === 'success') {
                displaySuccessModal(data.message);
                window.location.href = "confirmation.php";
            } else {
                displayErrorModal(data.message);
            }
        } catch (e) {
            console.error('Error parsing JSON response:', e);
            alert('An unexpected error occurred.');
        }
    }

    // Function to display a success modal
    function displaySuccessModal(message) {
    var modalContent = $('#modalContent');
    modalContent.html('<p class="text-green-600">' + message + '</p>');
    $('#customModal').show();
}

function displayErrorModal(message) {
    var modalContent = $('#modalContent');
    modalContent.html('<p class="text-red-600">Error: ' + message + '</p>');
    $('#customModal').show();
}


    // Function to close the modal
    function closeModal() {
        $('#customModal').hide();
    }
    </script>
    <?php
    include "createtable.php";
  ?>
  </body>
</html>